<?php
Yii::import('application.controllers.MyRentsController');
class ApiController extends MyRentsController {
    /*
     * раздаём доступы
     */

    public function filters() {
	return array('accessControl');
    }

    public function accessRules() {
	return array(
	    array('allow',
		'users' => array('*'),
		'message' => 'Access Denied.',
		'expression' => function($user) {
		    $key = UserApiKey::model()->findByPk($user->id);
		    if (isset($_GET['apikey']) && $key && $key->key == $_GET['apikey'])
			return true;
		    else
			return false;
		}
	    ),
	    array('deny', // deny all users
		'users' => array('*'),
		'message' => 'Access Denied.',
	    ),
	);
    }

    /**
     * получение полного списка аренд 
     */
    public function actionRentslist($view = 'rentlist') {
	if ($view == 'rentlist')
	    $user = User::model()
		    ->with(array(
			'rents' => array(
			    'width' => array(
				'rents.photos',
				'rents.descriptions',
				'rents.descriptions.lang',
				'rents.rent_todo',
				'rents.rent_type',
				'rents.currency',
				'rents.adress',
				'rents.neighbors',
				'rents.amenities',
			    ),
			    'limit' => 10,
			)
		    ))
		    ->findByPk(Yii::app()->user->id);
	else {
	    $user = User::model()->with('rents')->findByPk(Yii::app()->user->id);
	}

	if ($user) {
	    $rents = $user->rents;
	    header("content-type: text/xml");
	    $this->renderPartial($view, array('rents' => $rents));
	}
    }

    /*
     * индексная страница
     */

    public function actionIndex() {
	$view = 'api';
	$uploadedfile = Yii::app()->user->getState('apifile'); //берём загруженный фалй xml
	if ($uploadedfile && is_file($uploadedfile)) {
	    $this->execFile();
	} //если файл ещё не загружен - вызываем вью загрузки
	else {
	    $form = new GetFileForm();

	    $loaded = false;
	    if (isset($_POST['GetFileForm']))
		$loaded = $this->loadXMLFile($form);

	    if ($loaded)
		$this->execFile();
	    else
		$this->show($view, array('fileform' => $form));
	}
    }

    /**
     * обработка файла 
     */
    private function execFile() {
	$step = Yii::app()->params['api_execution_step'];
	$xml = simplexml_load_file(Yii::app()->user->getState('apifile'));
	$executed = Yii::app()->user->getState('api_executed');
	if ($executed === null) {
	    $executed = 0;
	    Yii::app()->user->setState('api_executed', 0);
	}
	$count = count($xml->advertisement);

	$end = (($executed + $step) > $count) ? $count : $executed + $step;
	//обработка данных в цикле (начиная с уже выполненной и заканчивая шагом)
	$error = array();
	for ($i = $executed; $i < $end; $i++) {
	    $error = ApiXmlExec::xml()->processAd($xml->advertisement[$i]);
	}
	$executed = $end;
	Yii::app()->user->setState('api_executed', $executed);
	//если обработка завершена, очищаем лишнее
	if ($executed == $count) {
	    unlink(Yii::app()->user->getState('apifile'));
	    Yii::app()->user->setState('apifile', null);
	    Yii::app()->user->setState('api_executed', null);
	    ApiXmlExec::xml()->processOther($xml);
	}
	$this->show('apiexecution', array(
	    'executed' => $executed,
	    'count' => $count,
	    'error'=>$error,
	));
    }

    /**
     * добавление аренды
     * @param type $advertisement
     * @return boolean 
     */
    private function addAdvertisement($advertisement) {
	$rent = new Rent();
	$rent->user = Yii::app()->user->id;
	$this->applyParamsAndSave($rent, $advertisement);
	return true;
    }

    /**
     * редактирование аренды
     * @param type $advertisement
     * @return boolean 
     */
    private function editAdvertisement($advertisement) {
	$rent = Rent::model()->findByPk((int) $advertisement->id);
	if ($rent->user == Yii::app()->user->id) {
	    $this->applyParamsAndSave($rent, $advertisement);
	}
	return true;
    }

    /**
     * удаление аренды
     * @param type $advertisement
     * @return boolean 
     */
    private function dropAdvertisement($advertisement) {
	Rent::model()->deleteByPk((int) $advertisement->id, array('condition' => 'user = :uid', 'params' => array(':uid' => Yii::app()->user->id)));
	return true;
    }

    /**
     * обработка аплоада файла
     * @param GetFileForm $form
     * @return boolean 
     */
    private function loadXMLFile($form) {
	$result = false;
	//инициализируем полученные данные 
	$form->attributes = $_POST['GetFileForm'];
	//проверяем данные, должен быть загружен файл
	//
	//if (!$form->url && !$form->file) {
	//    $form->addError('url', Yii::t('api', 'message.no.file.selected'));
	//    return false;
	//}

	if ($form->validate()) { //загружаем файлы и смотрим являются ли они валидными XMLниками
	    $filename = Yii::getPathOfAlias('webroot') . Yii::app()->params['TEMPDIR'] . '/' . Yii::app()->user->id . 'apiXML.xml';

	    //получаем и сохраняем файл
	    if ($form->url) {
		$file = new FileFromUrl($form->url);
		$file->saveAs($filename);
	    } elseif ($_FILES) {

		if ($file = CUploadedFile::getInstance($form, 'file')) {
		    $file->saveAs($filename);
		}
	    }
	    //проверяем на валидность XML

	    if (!is_file($filename) || !$xml = simplexml_load_file($filename)) {
		$form->addError('url', Yii::t('api', 'message.wrong.xml.file'));
		return false;
	    } else {
		//всё нормально файл загружен и является XML,
		$result = true;
		Yii::app()->user->setState('apifile', $filename);
	    }
	}
	return $result;
    }

    /**
     * подключение необходимых файлов и рендер
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params) {
	$cssFiles = array(
	    'style.css',
	    'tipTip.css',
	    'slide.css',
	    'jquery-ui-1.8.16.custom.css',
	    'jquery.jscrollpane.css',
	    'jquery.fancybox.css',
	    'cusel.css'
	);
	$jsFiles = array(
	    'menu.js',
	    'jquery.tipTip.js',
	    'jquery.jscrollpane.min.js',
	    'jScrollPaneSelect.js',
	    'jquery-ui-1.8.16.custom.min.js',
	    'somefunctions.js',
	    'jquery.imagetick.js',
	    'edit.js',
	    'cusel.js',
	    'charCount.js',
	    'jquery.multi-accordion-1.5.3.js',
	    'accordion_all.js',
	    'jquery.fancybox.js'
	);

	$this->assignControllerJsCss($cssFiles, $jsFiles);
	$this->render($view, $params);
    }

}
