<?php
Yii::import('application.controllers.MyRentsController');
class ApiDocController extends MyRentsController {

public $layout ='apilayout';


/*
 * Documentation API
 */
    public function actionApiDoc() {
$amenities = Amenity::model()->findAll();
$neighbors = Neighbor::model()->findAll();
		$this->assignAndRender('documentation_api', array('amenities' => $amenities, 'neighbors' => $neighbors));

    }

    /**
     * подключение необходимых файлов и рендер
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params) {
	$cssFiles = array(
	    'style.css',
	    'tipTip.css',

	);
	$jsFiles = array(
	    'jquery.tipTip.js',

	);

	$this->assignControllerJsCss($cssFiles, $jsFiles);
	$this->render($view, $params);
    }

}
