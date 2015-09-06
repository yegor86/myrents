<?php
Yii::import('application.controllers.MyRentsController');
class MembersController extends MyRentsController {

    public function actionIndex() {

                $this->assignAndRender('main');
    }
    public function assignAndRender($view, $params = array()) {
        $this->assignControllerJsCss(
                array(
            'style.css',
            'tipTip.css',
            'jquery-ui-1.8.16.custom.css',
            'members.css',
            'jquery.fancybox.css'
                ), array(
            'menu.js',
            'jquery.tipTip.js',
            'jquery.jscrollpane.min.js',
            'jquery-ui-1.8.16.custom.min.js',
            'jquery.jcarousel.min.js',
            'jquery.tipTip.js',
            'somefunctions.js', 'jquery.fancybox.js',
                )
        );
        $this->render($view, $params);
    }
}