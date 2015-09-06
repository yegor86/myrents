<?php
Yii::import('application.controllers.MyRentsController');
/**
 * Тестовый контроллер  - полигон для различных фунций 
 */
class TestController extends MyRentsController {

    public function actionTest() {
	$resp = '';
	$this->assignAndRender('test', array('response' => $resp));
    }

    
    public function assignAndRender($view, $params = array()) {
	$this->assignControllerJsCss(
		array(
	    'style.css',
	    'tipTip.css',
	    'slide.css',
	    'jquery-ui-1.8.16.custom.css',
	    'jquery.jscrollpane.css',
	    'jquery.fancybox.css',
	    'cusel.css'
		), array(
	    'menu.js',
	    'jquery.tipTip.js',
	    'jquery.jscrollpane.min.js',
	    'jScrollPaneSelect.js',
	    'jquery-ui-1.8.16.custom.min.js',
	    'jquery.jcarousel.min.js',
	    'somefunctions.js',
	    'jquery.imagetick.js',
	    'edit.js',
	    'cusel.js',
	    'charCount.js',
	    'jquery.multi-accordion-1.5.3.js',
	    'accordion_no.js',
	    'MRAjaxLibrary.js',
	    'jquery.fancybox.js',
	    'jquery.keyboard.js',
	    'jquery.cycle.js'
		)
	);
	$this->render($view, $params);
    }

}
