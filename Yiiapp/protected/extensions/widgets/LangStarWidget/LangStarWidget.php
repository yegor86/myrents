<?php

class LangStarWidget extends BaseWidget {
    public $langs;
    public $langsArray;
    public $form;
    public $user;
    public $edit = false;
    
    public function init() {
	    parent::init(__FILE__);
	    $this->addClientCsriptFiles();
	// этот метод будет вызван методом CController::beginWidget()
    }

    public function run() {
	if($this->edit)
	$this->render('edit',array('langs'=>  $this->langs, 'langsArray'=>  $this->langsArray, 'form'=>  $this->form, 'user'=>$this->user));
	else $this->render('show',array('user'=> $this->user));
    }

     private function addClientCsriptFiles(){
	$cs = Yii::app()->clientScript;
	$cs->registerCssFile($this->_assetsUrl.'/css/langstar.css');
	$cs->registerScriptFile($this->_assetsUrl . '/js/AddLang.js', CClientScript::POS_HEAD);		
    }
}

?>
