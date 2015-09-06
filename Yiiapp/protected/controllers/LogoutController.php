<?php
Yii::import('application.controllers.MyRentsController');
class LogoutController extends MyRentsController {
    public function actionLogout() {
	$redirect = Yii::app()->user->returnUrl;
	Yii::app()->cache->delete(Yii::app()->User->id . 'cachedUser');
	Yii::app()->user->logout();
	$this->redirect ($redirect);
    }

}