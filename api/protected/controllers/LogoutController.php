<?php
Yii::import('application.controllers.MyRentsController');
class LogoutController extends MyRentsController {

    public function actionLogout() {
	Yii::app()->cache->delete(Yii::app()->User->id . 'cachedUser');
	Yii::app()->user->logout();
	$url = (Yii::app()->request->urlReferrer) ? Yii::app()->request->urlReferrer : Yii::app()->homeUrl;
	$this->redirect($url);
    }

}