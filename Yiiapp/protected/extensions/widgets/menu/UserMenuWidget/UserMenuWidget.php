<?php

class UserMenuWidget extends BaseWidget {
    public $visible = false;
    public function init() {
	    parent::init(__FILE__);
	    $this->addClientCsriptFiles();
	// этот метод будет вызван методом CController::beginWidget()
    }
    public function run() {
	if ($this->visible)  $this->render('userMenu');
    }

    
   private function addClientCsriptFiles(){
	$cs = Yii::app()->clientScript;
	$cs->registerScriptFile($this->_assetsUrl . '/js/userMenu.js', CClientScript::POS_HEAD);
	$cs->registerCssFile($this->_assetsUrl.'/css/userMenu.css');

    }

}

?>
