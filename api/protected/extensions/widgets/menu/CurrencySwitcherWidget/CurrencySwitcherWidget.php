<?php

class CurrencySwitcherWidget extends BaseWidget {
    public function init() {
	    parent::init(__FILE__);
	    $this->addClientCsriptFiles();
	// этот метод будет вызван методом CController::beginWidget()
    }
    public function run() {
    $this->render('currencySwitcher', array('currencies' => $this->controller->currencies, 'currentCurrency' => $this->controller->currentCurrency));
    }

    
   private function addClientCsriptFiles(){
	$cs = Yii::app()->clientScript;
	$cs->registerScriptFile($this->_assetsUrl . '/js/currencyswitcher.js', CClientScript::POS_HEAD);
	$cs->registerCssFile($this->_assetsUrl.'/css/currencySwitcher.css');

    }

}

?>
