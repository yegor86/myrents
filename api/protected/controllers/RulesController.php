<?php

Yii::import('application.controllers.MyRentsController');
class RulesController extends MyRentsController {


    public function actionIndex() {
	$this->assignAndRender('index');
	
    }
    


    
    
    /**
     * подключение необходимых файлов и рендер
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params=array()) {
	$this->assignControllerJsCss(
		array(
	    'style.css',

	    'slide.css',
	    'jquery-ui-1.8.16.custom.css',
	    'jquery.jscrollpane.css',
	    'jquery.ad-gallery.css',
                    'jquery.fancybox.css'
		), array(
	    'menu.js',

	    'jquery.jscrollpane.min.js',
	    'jquery.ad-gallery.js',
	    'jquery-ui-1.8.16.custom.min.js',
	    'jquery.jcarousel.min.js',

	    'somefunctions.js','jquery.fancybox.js',
		)
	);
	$this->render($view, $params);
    }

}
?>
