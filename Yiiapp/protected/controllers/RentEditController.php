<?php
Yii::import('application.controllers.RentEditMainController');
class RentEditController extends RentEditMainController {

    public function actionEdit($id = 0) {
	$rent = Rent::model()->with('renter', 'renter.language', 'renter.language.lang', 'rent_type')
		->findByPk($id);
	if ($rent) {
		$typesArray = $this->modelsNamestoArray(Type::model()
				->cache(Yii::app()->params['cachetime'])->findAll());  //массив значений для типов аренды
		$todoArray = $this->modelsNamestoArray(Todo::model()
				->cache(Yii::app()->params['cachetime'])->findAll());   //массив значений для действий аренды
		/**
		 * поскольку количество языков выбранных пользователм могло изменится и отличается 
		 * от текущего количества описаний аренды 
		 * то перебираем все языки пользователя и сопоставляем с описанием, если таких нет, то добавляем
		 */
		$langs = $this->langs;
		/**
		 * если запроса на изменение небыло, то выбираем текущие описания
		 *  поскольку после выбора они будет иметь ключи 0-n, не совпадающие с IDшниками языков,
		 *  то делаем рокировку
		 */
		if (!isset($_POST['Rent'])) {
		    $descriptions = array(); //тут будет лежать новый массив описаний аренд
		    foreach ($rent->descriptions as $description) {
			$descriptions[$description->language] = $description;
		    }
		    $rent->descriptions = $descriptions;
		} else {
		    $this->applyParamsAndSave($rent);
		}

		$notExistLang = $this->setNotExistsLangDescriptionAtRent($rent);
		$this->assignAndRender('edit', array('rent' => $rent, 'Types' => $typesArray, 'Todo' => $todoArray, 'langs' => $langs, 'notExistLangs' => $notExistLang));
	} else
	    throw new CHttpException(404, 'page not found');
    }

    /**
     * создание списка неуказанных языков аренды
     * @param type $rent
     * @return type 
     */
    private function setNotExistsLangDescriptionAtRent($rent) {
	$result = $this->langs;
	foreach ($rent->descriptions as $description) {
	    foreach ($result as $key => $lang) {
		if ($description->language == $lang->id)
		    unset($result[$key]);
	    }
	} return $result;
    }

    /**
     * применение параметров, валидация и сохранение
     * @param Rent $rent 
     */
    private function applyParamsAndSave($rent) {
	$valid = true; //ключ валидности
	$descriptions = array();
	$rent->attributes = $_POST['Rent'];
	if ($rent->todo != 1) {
	    $rent->current_price = 1;
	    $rent->price_month = 0;
	    $rent->price_week = 0;
	}
	if (isset($_POST['RentDescription']))
	    foreach ($_POST['RentDescription'] as $langId => $oneDescription) {      //создаём полученные в запросе описания
		$descriptions[$langId] = new RentDescription();
		$descriptions[$langId]->attributes = $oneDescription;
		$descriptions[$langId]->language = $langId;
		$valid = $descriptions[$langId]->validate() && $valid;   //валидация
	    }

	if (!isset($descriptions[Yii::app()->params['requiredLang']])) {  //если каким-то образом обязательный язык не пришел в запросе
	    $descriptions[Yii::app()->params['requiredLang']] = new RentDescription(); //  создаём описание для требуемого языка, 
	    $descriptions[Yii::app()->params['requiredLang']]->language = Yii::app()->params['requiredLang'];
	    $valid = $descriptions[Yii::app()->params['requiredLang']]->validate() && $valid;
	}
	$valid = $rent->validate() && $valid;
	if ($valid)
	    foreach ($rent->descriptions as $description) {
		$description->delete();
	    }
	$rent->descriptions = $descriptions;
	if ($valid) {  //если всё ОК
	    $rent->save();
	    $rent->saveDescriptions(true); //сохраняем аренду
	    Yii::app()->user->setFlash('success', Yii::t('default', 'flash.bill.saved'));   //добавляем сообщение об успешном сохранении
	    if (isset($_POST['newdoc']))
		if ($_POST['newdoc'])
		    $this->redirect($_POST['newdoc']); //если есть переход на другую страницу - переходим
		else $this->refresh ();
		
	} else{
	   //print_r($rent->getErrors());
	    Yii::app()->user->setFlash('error', Yii::t('default', 'mesage.not.saved'));   //добавляем сообщение об неуспешном сохранении
	}
    }

    /**
     * подключение необходимых файлов и рендер
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params) {
	$this->assignControllerJsCss(
		array(
	    'style.css',
	    'tipTip.css',
	    'slide.css',
	    'jquery-ui-1.8.16.custom.css',
	    'jquery.jscrollpane.css',
	    'cusel.css',
                    'jquery.fancybox.css'
		), array(
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
                    'jquery.fancybox.js',
                    'jquery.keyboard.js',
		    		 //   'upScript.js' //скрипт для апов
		)
	);
	$this->render($view, $params);
    }

}

?>
