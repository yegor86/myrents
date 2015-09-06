<?php

class BaseWidget extends CWidget {
    protected $_assetsUrl;
    protected $_fast;
    public function init( $ScriptPath = __FILE__ ) {
		$dirname = dirname($ScriptPath);
		$this->registerAssets($dirname);
	// этот метод будет вызван методом CController::beginWidget()
    }

    public function run() {

    }

    
    public function fastrun(){
	$this->_fast = true;
	$this->run();
    }
    /**
     * Register CSS and JS files.
     */
    protected function registerAssets($dirname) {
	$cs = Yii::app()->clientScript;
	$cs->registerCoreScript('jquery');
	$assets_path = $dirname . DIRECTORY_SEPARATOR . 'assets';
	$url = Yii::app()->assetManager->publish($assets_path, false, -1, YII_DEBUG);
	$this->_assetsUrl = $url;
	
    }
    
    private function addClientCsriptFiles(){
    }

    
    public function getAssetsUrl() {
	if ($this->_assetsUrl === null)
	    $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
		    dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets');
	return $this->_assetsUrl;
    }

}

?>
