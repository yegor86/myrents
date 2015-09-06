<?php

class UserTabsWidget extends BaseWidget {

    public $user;
    public $view;
    public $activetab;


    public function init() {
	    parent::init(__FILE__);
	    $this->addClientCsriptFiles();
	// этот метод будет вызван методом CController::beginWidget()
    }
    public function run() {
	    $this->render($this->view, array('id' => $this->user->id,'activetab'=>$this->activetab));
    }

    
   private function addClientCsriptFiles(){
//	$cs = Yii::app()->clientScript;
//	$cs->registerScriptFile($this->_assetsUrl . '/js/jquery.imagetick.js', CClientScript::POS_HEAD);
//	$cs->registerScriptFile($this->_assetsUrl . '/js/AmenityWidget.js', CClientScript::POS_HEAD);
    }

}

?>
