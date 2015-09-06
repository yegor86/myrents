<?php
Yii::import('application.controllers.MyRentsController');
Yii::import('application.models.adminForms.*');
class AdminController extends MyRentsController {
    
    public $layout ='adminlayout';
    
    public function filters() {
	return array(
	    'accessControl'
	);
    }

    public function accessRules() {
	return array(
	    array('allow',
		'users' => array('@'),
		'roles' => array('admin'),
		'message' => 'Access Denied.',
	    ),
	    array('deny', // deny all users
		'users' => array('*'),
		'message' => 'Access Denied.',
	    ),
	);
    }

    /**
     * подключение необходимых файлов и рендер
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params=array()) {
	$cssFiles = array(
	    'admin_style.css',

	);
	$jsFiles = array(
	    'menu.js',

	);

	$this->assignControllerJsCss($cssFiles, $jsFiles);
	$this->render($view, $params);
    }

    
    protected function paginate($criteria,$class=false){
        if($class)
        $pagination = new CPagination($class::model()->count($criteria));
        else $pagination = new CPagination();
        $pagination->setPageSize(Yii::app()->params['adminResultsPerPage']);
        $pagination->pageVar = 'page';
        $pagination->applyLimit($criteria);
        return $pagination;
    }
}

?>
