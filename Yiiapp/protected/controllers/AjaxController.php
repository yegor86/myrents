<?php

/*
 * контроллер для различных запросов
 * 
 */
Yii::import('application.controllers.MyRentsController');
class AjaxController extends MyRentsController {

    //установка валюты
    public function actionSetcurrency() {
	if (isset($_POST['currency']) && preg_match('/^\d+$/', $_POST['currency'])) {
	    Yii::app()->request->cookies['currency'] = new CHttpCookie('currency', $_POST['currency']);
	    Yii::app()->params['Currency'] = $_POST['currency'];
	    $this->renderPartial('refreshWindowFromJs');
	}
    }

    //переключаение видимости аренды
    public function actionSwitchRentView() {
	if ((!Yii::app()->User->isGuest)	  //пользователь авторизирован
		&& // и
		isset($_POST['rentId'])		   //получили ли idшник аренды
		&& // и
		(is_numeric($_POST['rentId']))	//является ли он числом
		&& //и 
		($rent = Rent::model()->findByPk($_POST['rentId'], '`user` = ' . Yii::app()->User->id)) //прошел запрос поиска аренды где автор - авторизированный пользователь
		&& ($rent)					//  и аренда была найдена
	) {
	    $rent->in_show = ($rent->in_show) ? 0 : 1;  //тогда переключаем аренду
	    $rent->save();
	    //Yii::app()->user->setFlash('success', Yii::t('default', 'Аренда сохранена'));
	    $this->renderPartial('SwitchRentViewButton', array('rent' => $rent), false, true);
	} else {
	    // Yii::app()->user->setFlash('success', Yii::t('default', 'Аренда не сохранена'));
	}
    }
    
    /**
     *запрос на форму для добавления языка 
     */
    public function actionDescrForm() {
	if (!Yii::app()->User->isGuest && $_POST['lang']  && ($this->user->active)) {
	    $lang = Language::model()->findByPk($_POST['lang']);
	    $RentDescription = new RentDescription();
	    $RentDescription->language = $_POST['lang'];
	    $this->renderPartial('newRentDescrForm', array('langname'=>$lang->name,'key' => $_POST['lang']));
	}
    }
    
    
    /**
     *переключения языка постовым запросом 
     */
    public function actionSwitchLang(){
	if(isset($_POST['lang'])&&in_array($_POST['lang'],Yii::app()->params['langs'])){ //если есть запрос - устанавливаем язык в куки
	             Yii::app()->request->cookies['lang'] = new CHttpCookie('lang', strtolower($_POST['lang']));
                               Yii::app()->language=$_POST['lang'];                                                      
	}
	 $this->renderPartial('refreshWindowFromJs');
    }
    
    /**
     *добавление аренды в закладки 
     */
    public function actionAddToFavorites(){
	if(!Yii::app()->User->isGuest&&isset($_POST['id']) && ($this->user->active)){
	    
	    $rent_id = (int) $_POST['id'];
	    $user_id = Yii::app()->User->id;
	    $db = Yii::app()->db
		->createCommand("INSERT IGNORE INTO `FavoritesRent` (`rent_id`,`user_id`)  VALUES ($rent_id,$user_id)")
		->execute();
	    $this->renderPartial('favorite');
	}
	
    }
    
    /**
     *список регионов для выбранного города
     */
    public function actionRegions(){
	$regions = array();
	if(isset($_POST['getregions'])&&$_POST['getregions']){
            $regions= CustomFunctions::RegionsForCity($_POST['getregions']);
	}
	$jsonregions = json_encode($regions);

	$this->renderPartial('regions',array('regionlist'=>$jsonregions));
    }

}

?>
