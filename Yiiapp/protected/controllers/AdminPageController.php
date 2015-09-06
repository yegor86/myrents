<?php
Yii::import('application.controllers.AdminController');
class AdminPageController extends AdminController{
    public function actionAdminmain(){
	$this->assignAndRender('adminMain');
	
    }

    /*Удаление Асестов*/
    public function actionAdminClear() {
	if(isset($_POST['drop_assets'])) $this->drop_assets();
	$this->assignAndRender('adminClear');
    }
    //удаление ассестов
    private function drop_assets(){
	$fs = MRFileSystem::fs ('assets',Yii::getPathOfAlias('webroot') )->cleardir();
	Yii::app()->user->setFlash('deleted','assets was cleared');
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