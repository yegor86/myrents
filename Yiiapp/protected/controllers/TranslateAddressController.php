<?php
Yii::import('application.controllers.AdminController');
class TranslateAddressController extends AdminController {
    public function actionTreeTranslator(){
	$view = '/import/index';
	$ajaxurl = '/translatetree';
	$step = 1;
	$criteria = new CDbCriteria();
	$criteria->condition='name_en = ""';
	$count = AddressTree::model()->cache(Yii::app()->params['cachetime'])-> count($criteria);
	$form = new StepExecutionForm();
	$completed = false;
	if (isset($_POST['StepExecutionForm'])) {
	    $form->attributes = $_POST['StepExecutionForm'];
	    $criteria = new CDbCriteria();
	    $criteria->condition='name_en = ""';
	    $criteria->offset = $form->start;
	    $end = $form->start + $step;
	    if ($end > $count - 1) {
		$end = $count - 1;
		$completed = true;
	    }
	    $address = AddressTree::model()->find($criteria);
	    $this->ExecuteTranslation($address);
	     $form->start = $end;
	}
	if (isset($_POST['isajax']))
	    $this->renderPartial('/import/_form', array('count' => $count, 'formModel' => $form, 'completed' => $completed, 'reload' => true,'url'=>$ajaxurl));
	else
	    $this->assignAndRender($view, array('count' => $count, 'formModel' => $form, 'completed' => $completed, 'reload' => false,'url'=>$ajaxurl));
    }
    
    
        public function actionAddressTranslator(){
	$view = '/import/index';
	$ajaxurl = '/translateaddress';
	$step = 1;
	$criteria = new CDbCriteria();
	$criteria->condition='`name_en` = ""';
	//$criteria->offset = $form->start;
	$count = Adress::model()->cache(Yii::app()->params['cachetime'])-> count($criteria);
	$form = new StepExecutionForm();
	$completed = false;
	if (isset($_POST['StepExecutionForm'])) {
	    $form->attributes = $_POST['StepExecutionForm'];
	    //$criteria->offset = $form->start;
	    $end = $form->start + $step;
	    if ($end > $count - 1) {
		$end = $count - 1;
		$completed = true;
	    }
	    $address = Adress::model()->find($criteria);
	    $this->ExecuteTranslation($address);
	     $form->start = $end;
	}
	if (isset($_POST['isajax']))
	    $this->renderPartial('/import/_form', array('count' => $count, 'formModel' => $form, 'completed' => $completed, 'reload' => true,'url'=>$ajaxurl));
	else
	    $this->assignAndRender($view, array('count' => $count, 'formModel' => $form, 'completed' => $completed, 'reload' => false,'url'=>$ajaxurl));
    }

    
    //выполнение перевода
    private function ExecuteTranslation($treeObj){
	if(!$treeObj->name_en) {$treeObj->name_en = Yii::app()->bing->translate($treeObj->name);
	     $treeObj->save();
	}
	}
    
}
