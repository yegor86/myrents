<?php
Yii::import('application.controllers.MyRentsController');
class SiteController extends MyRentsController {
public $layout = 'mainlayout';
    /**
     * Declares class-based actions.
     */
    public function actions() {
	return array(

	    'page' => array(
		'class' => 'CViewAction',
	    ),
	);
    }
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
	// renders the view file 'protected/views/site/index.php'
	// using the default layout 'protected/views/layouts/main.php'
	
	$price = Yii::app()->params['prices'];
	$typesArray = $this->modelsNamestoArray(Type::model()->cache(Yii::app()->params['cachetime'])
			->findAll());  //массив значений для типов аренды
	$todoArray = $this->modelsNamestoArray(Todo::model()->cache(Yii::app()->params['cachetime'])
			->findAll(),'id','name','mainpage');   //массив значений для действий аренды
	
	
	$searchForm = new SearchForm;
	$searchForm->pricemin = $price['min'];
	$searchForm->pricemax = $price['max'];
	$searchForm->squaremin = Yii::app()->params['squares']['min'];
	$searchForm->squaremax = Yii::app()->params['squares']['max'];
	$searchForm->todo=1;
	//SEO ссылки
	
	$seoLinks = $this->createSeoLinks();
	$selectedRentsIds =array();
	$selectedRentsIds = TopFunc::init()->getMainPageIds();

	$selectedRents = count($selectedRentsIds)?
		Rent::model()->with(array(
		'photos',
		'adress' => array('joinType' => 'INNER JOIN'),
		'renter',
	    	'descriptions' => array(
		    'joinType' => 'LEFT OUTER JOIN',
		    'select' => 'name',
		    'on' => 'language=' . $this->curlang->id,
		)
		))->findAll('`t`.`id` IN ('.  implode(',', $selectedRentsIds).')')
		:array();
	 
	$this->assignAndRender('index', array(
	    'searchForm' => $searchForm,
	    'Types' => $typesArray, //перечень типов
	    'Todos' => $todoArray, //перечень действий
	    'Prices' => $price, //минимальное и максимальное значение цены
	    'rents'=>$selectedRents //выбранные в топ объявления
	));
    }

    public function actionError404() {
	throw new CHttpException(404, 'error page not found');
    }

    /**
     * подключение необходимых файлов и рендер
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params) {
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