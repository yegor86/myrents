<?php
Yii::import('application.controllers.MyRentsController');
class AgencyEditController extends MyRentsController {

    public function actionEdit($id = 0) {
	print_r($id);die();
	if(Yii::app()->user->isGuest){
	    header("HTTP/1.0 403 Forbidden");
	    $this->assignAndRender('not_allowed_to_edit');
	    return false;
	}
	$agency = Agency::model()
		->with(array('adminUsers'))
		->findByPk($id);
	

	if (!$agency) {
	    header("HTTP/1.0 404 Not Found");
	    $this->assignAndRender('404_agency_not_found');
	} elseif (!in_array(Yii::app()->user->id, CHtml::listBox($agency->adminUsers, 'id', 'id'))) {
	    header("HTTP/1.0 403 Forbidden");
	    $this->assignAndRender('not_allowed_to_edit');
	}else{
	    print_r('OK');
	}
    }
    
    
}