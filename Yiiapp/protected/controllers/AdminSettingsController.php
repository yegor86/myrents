<?php
Yii::import('application.controllers.AdminController');
class AdminSettingsController extends AdminController{
    public function actionAdminSettings(){
	$this->assignAndRender('adminSettings');
	
    }
    
    
        /**
     * подключение необходимых файлов и рендер
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params=array()) {
	$this->assignControllerJsCss(
		array(
	    'admin_style.css',

		), array(
	    'admin_func.js',

		)
	);
	$this->render($view, $params);
    }

}