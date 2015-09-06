<?php
Yii::import('application.controllers.MyRentsController');
class RentCreateController extends MyRentsController {

    /**
     * Создание аренды
     * Аренда создаётся только в случае, если все описания заполнены 
     */
    public function actionCreate() {
	if (!Yii::app()->user->isGuest && ($this->user->active)) {      //если пользователь зарегистрирован
	    $rent = new Rent;	// создаём модель аренды
	    // функция radioburronlist принимает в качестве списка значений массив в виде 
	    //array ('значение'=>'подпись'), составляем такой массив из полученного массива моделей типа
	    $typesArray = $this->modelsNamestoArray(Type::model()->cache(Yii::app()->params['cachetime'])->findAll());  //массив значений для типов аренды
	    $todoArray = $this->modelsNamestoArray(Todo::model()->cache(Yii::app()->params['cachetime'])->findAll());   //массив значений для действий аренды
	    $rent->user = Yii::app()->user->id;  //владелей аренды - авторизированный пользователь
	    $langs = $this->langs; // получаем список языков
	    $descriptions = array();
	    if (isset($_POST['Rent'])) {
		$this->applyParamsAndSave($rent);    //если есть запрос на сохранение аренды
	    } else {
		$description = new RentDescription ();
		$description->language = Yii::app()->params['requiredLang'];
		$rent->descriptions = array(Yii::app()->params['requiredLang'] => $description);
	    }
	    $this->assignAndRender('create', array('Rent' => $rent, 'Types' => $typesArray, 'Todo' => $todoArray, 'langs' => $langs));
	} else {

	    Yii::app()->user->setFlash('error', Yii::t('default', 'flash.to.create.bill.you.need.register'));
	    $this->redirect('/register');
	}
    }

    /**
     * применение параметров, валидация и сохранение
     * @param Rent $rent 
     */
    private function applyParamsAndSave($rent) {
	$valid = true; //ключ валидности

	$rent->attributes = $_POST['Rent']; //параметры аренды (todo, type, floor, rooms_count)
	$rent->in_show=1;
	$descriptions = array(); //массив, куда будут складываться полученные дексрипшны
	$valid = true;
	if (isset($_POST['RentDescription']))
	    foreach ($_POST['RentDescription'] as $langId => $oneDescription) {      //создаём полученные в запросе описания
		$descriptions[$langId] = new RentDescription();
		$descriptions[$langId]->attributes = $oneDescription;
		$descriptions[$langId]->language = $langId;
		$valid = $descriptions[$langId]->validate() && $valid;			//валидация
	    }

	if (!isset($descriptions[Yii::app()->params['requiredLang']])) {  //если каким-то образом обязательный язык не пришел в запросе
	    $descriptions[Yii::app()->params['requiredLang']] = new RentDescription(); //  создаём описание для требуемого языка, 
	    $descriptions[Yii::app()->params['requiredLang']]->language = Yii::app()->params['requiredLang'];
	    $valid = $descriptions[Yii::app()->params['requiredLang']]->validate() && $valid;
	}
	$rent->descriptions = $descriptions;
	$rent->last_up = $rent->last_modify = date("Y-m-d H:i:s");
	$valid = $rent->validate() && $valid;
	if ($valid) {   //если всё ОК
	    $rent->save();
	    //$rent->last_up  = $rent->last_modify =  $rent->creation_date;$rent->save();
	    $rent->saveDescriptions(TRUE); //сохраняем аренду
	    Yii::app()->user->setFlash('success', Yii::t('default', 'flash.bill.saved'));   //добавляем сообщение об успешном сохранении
	    $this->redirect('/rent/' . $rent->id . '/edit/');    //и редирект на страницу редактирования
	} else
	    Yii::app()->user->setFlash('error', Yii::t('default', 'mesage.not.saved'));   //добавляем сообщение об неуспешном сохранении
	
	
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

?>
