<?php

/**
 * класс приёма-отправки сообщений, наследуется от класса пользователя
 */
Yii::import('application.controllers.MyRentsController');

class NewsController extends MyRentsController {


    public function actionNews() {
$newslist = '';
$this->assignAndRender('news', array('newslist'=>$newslist));
    }

    
    
        public function assignAndRender($view, $params=array()) {
	$this->assignControllerJsCss(
		array(
	    'style.css',
	    'tipTip.css',
	    'slide.css',
	    'jquery-ui-1.8.16.custom.css',
	    'jquery.jscrollpane.css',

                    'jquery.fancybox.css'
		), array(
	    'menu.js',
	    'jquery.tipTip.js',
	    'jquery.jscrollpane.min.js',
	    'jquery.keyboard.js',
	    'jquery-ui-1.8.16.custom.min.js',
	    'jquery.jcarousel.min.js',
	    'jquery.tipTip.js',
	    'somefunctions.js','jquery.fancybox.js',
                    'jquery.mousewheel.js'
		)
	);
	$this->render($view, $params);
    }


}
