<?php
Yii::import('application.controllers.MyRentsController');
class RentEditMainController extends MyRentsController {

    public function filters() {
	return array(
	    'accessControl'
	);
    }

    public function accessRules() {
	$owner_id = 0;
	if($_GET['id']){
	    $model = Rent::model()->findByPk($_GET['id']);
	    $owner_id= $model?$model->user:0;
	}
	return array(
	    array('allow',
		'users' => array('@'),
		'expression'=>"($owner_id&&(Yii::app()->user->id == $owner_id))",
		'message' => Yii::t('default','access denied'),

	    ),
	    array('allow',
		'roles' => array('moderator'),
		'message' => Yii::t('default','access denied'),
	    ),
	    array('deny', // deny all users
		'users' => array('*'),
		'message' => 'Access Denied.',
	    ),
	);
    }

}

?>
