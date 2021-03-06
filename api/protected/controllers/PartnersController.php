<?php

Yii::import('application.controllers.MyRentsController');
class PartnersController extends MyRentsController {


    public function actionIndex() {
       $partnerlist = Partner::model()->with(array('translations'=>array('on'=>'`lang_id`= ' . $this->curlang->id)))->findAll();

	$this->assignAndRender('index', array('partnerlist'=>$partnerlist));
	
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
	    'tipTip.css',
	    'slide.css',
	    'jquery-ui-1.8.16.custom.css',
	    'jquery.jscrollpane.css',
	    'jquery.ad-gallery.css',
                    'jquery.fancybox.css'
		), array(
	    'menu.js',
	    'jquery.tipTip.js',
	    'jquery.jscrollpane.min.js',
	    'jquery.ad-gallery.js',
	    'jquery-ui-1.8.16.custom.min.js',
	    'jquery.jcarousel.min.js',
	    'jquery.tipTip.js',
	    'somefunctions.js','jquery.fancybox.js',
		)
	);
	$this->render($view, $params);
    }

}
?>
