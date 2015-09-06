<?php

class CheckBoxWidget extends BaseWidget {

    public $params = array('modelsList'=>array(),'existArray'=>array());


    public function init() {
	    parent::init(__FILE__);
	    $this->addClientCsriptFiles();
	// этот метод будет вызван методом CController::beginWidget()
    }
    public function run() {
	$form = $this->params['form'];
	foreach ($this->params['modelsList'] as $key => $model) {
	    $activeclass = '';
	    $checked = false;
	    if (in_array($model->id, $this->params['existArray'])) {
		$activeclass = 'active';
		$checked = 'checked';
	    }
	    $this->render($this->params['view'], array('form' => $form, 'key' => $key, 'checked' => $checked, 'model' => $model));
	}
    }

    
   private function addClientCsriptFiles(){
	$cs = Yii::app()->clientScript;
	$cs->registerScriptFile($this->_assetsUrl . '/js/jquery.imagetick.js', CClientScript::POS_HEAD);
	$cs->registerScriptFile($this->_assetsUrl . '/js/AmenityWidget.js', CClientScript::POS_HEAD);
    }

}

?>
