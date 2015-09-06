<?php
Yii::import('application.controllers.AdminController');
class AdminContentController extends AdminController{
    
    
    /*Список партнеров*/
    public function actionAdminContent(){
	$this->assignAndRender('adminContent');
    }
    
    /*Редактирование партнера*/
    public function actionAdminContentEdit($id){
	$this->assignAndRender('adminContentEdit');
    }
    
    /*Добавление партнера*/
    public function actionAdminContentAdd(){
	$this->assignAndRender('adminContentAdd');
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