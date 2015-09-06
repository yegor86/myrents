<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::import('application.controllers.MyRentsController');
class SearchController extends MyRentsController {

    /**
     * Заполнение формы данными
     * @param type $searchForm - форма, которую заполняем 
     * @param type $price           - массив с минимальной и максимальной ценой
     * @param type $squares      - массив с минимальной и максимальной площадью
     */
    private function fillform($searchForm, $price, $squares) {
	if (isset($_GET['SearchForm'])) {  //если был запрос на поиск
	    $searchForm->attributes = $_GET['SearchForm']; //заполняем  модель формы
	    $searchForm->rooms_count = (isset($_GET['SearchForm']['rooms_count'])) ? $_GET['SearchForm']['rooms_count'] : $searchForm->rooms_count;
	    $searchForm->amenities = (isset($_GET['SearchForm']['Amenity'])) ? array_keys($_GET['SearchForm']['Amenity']) : array();
	    $searchForm->neiborhood = (isset($_GET['SearchForm']['Neighbor'])) ? array_keys($_GET['SearchForm']['Neighbor']) : array();
	    $searchForm->searchString = trim($searchForm->searchString);
	    if (isset($_GET['SearchForm']['current_price']) && ($_GET['SearchForm']['current_price']))
		$searchForm->current_price = $_GET['SearchForm']['current_price'][0];
	}
	$searchForm->pricemin = (isset($_GET['SearchForm']['pricemin'])) ? $_GET['SearchForm']['pricemin'] : $price['min'];
	$searchForm->pricemax = (isset($_GET['SearchForm']['pricemax'])) ? $_GET['SearchForm']['pricemax'] : $price['max'];
	$searchForm->squaremax = (isset($_GET['SearchForm']['squaremax'])) ? $_GET['SearchForm']['squaremax'] : $squares['max'];
	$searchForm->squaremin = (isset($_GET['SearchForm']['squaremin'])) ? $_GET['SearchForm']['squaremin'] : $squares['min'];
    }

    /**
     * инпуты в список для чекбосков
     * @param type $array 
     */
    protected function array_to_checkboxlist($array = array()) {
	$result = array();
	foreach ($array as $key => $value) {
	    $result[$key] = $value['name'];
	}
	return $result;
    }

    //общая страница поиска
    public function actionSearch() {
	/** сбор данных */
	$searchForm = new SearchForm();  //модель поисковой формы
	$searchForm->todo =1;
	$searchForm->type =1;
	$language = $this->curlang;
	$squares = Yii::app()->params['squares'];
	
	
	$price = (isset($_GET['SearchForm']['todo'])&&$_GET['SearchForm']['todo']!=1)
	    ?$price = Yii::app()->params['prices_sale']
	    :Yii::app()->params['prices'];
	$allprices = array(
		'rent'=>Yii::app()->params['prices'],
		'sale'=>Yii::app()->params['prices_sale']
	    );
	
	
	$price['currency'] = $this->currentCurrency->rate;
	$prices_to_view = Yii::app()->params['current_price'];

	$prices_to_checkbox = Yii::app()->cache->get('prices_to_checkbox');
	if ($prices_to_checkbox === false) {
	    $prices_to_checkbox = $this->array_to_checkboxlist($prices_to_view);
	    Yii::app()->cache->set('prices_to_checkbox', $prices_to_checkbox, Yii::app()->params['cachetime']);
	}

	$orderList = array();
	foreach(Yii::app()->params['order_rows'] as $key=>$value){
	    $orderList[$key]=Yii::t('default',$value);
	}
	
	/* заполнение формы * */
	$this->fillform($searchForm, $price, $squares);

	// ищем аренды по данным из формы
	$result = SearchEngine::engine()->setParams($searchForm, $language, $price, $squares)
		->searchRents();

	/** получение списка найденных аренд и пагинации  */
	$rents = $result['rents'];
	$pagination = $result['pagination'];
	$count = $result['count'];
	
	
	//выводить указанную цену или указанную в настройках аренды
	$priced = (isset($_GET['SearchForm']["current_price"][0]))?$_GET['SearchForm']["current_price"][0]:false;
	/** вывод */
		

	$top = Rent::model()->with(array('photos', 'adress','currency',
			    'descriptions' => array(
				'select' => 'name',
				'params' => array(':lang' => $this->curlang->id),
				'joinType' => 'LEFT OUTER JOIN ',
				'on' => '`descriptions`.`language`=:lang'),
			'top'
			))->findAllByPk(TopFunc::init()->getTopIds(),array('condition'=>'`is_deleted` <> 1 AND in_show=1',
			    'order'=>'`top`.`start` DESC'));
	
	
	if (Yii::app()->request->isAjaxRequest) {   //если запрос был аяксовый, то возвращаем только результат поиска

	    if(isset($_GET['SearchForm']["mapsearch"])&&($_GET['SearchForm']["mapsearch"])){//поиск по карте - возврат JSON
		$arrayToJson = array();
		foreach ($rents as $rent) {
		    //{geoX, geoY, title, link, avatar, price, shortname, cur_row}
		    $trow = array();

		    if ($rent->todo == 1) {
			$tprice = number_format($rent->$prices_to_view[$rent->current_price]['row'] * $rent->currency->rate / $this->currentCurrency->rate, 0, ',', ' ');
		    } else {
			$tprice = number_format($rent->price_day * $rent->currency->rate / $this->currentCurrency->rate, 0, ',', ' ');
		    }
		    if ($rent->todo == 3) {
			$mapavatar = $this->getAssetsUrl() . '/images/buy_image_s.png';
		    } elseif ($rent->cover) {
			$mapavatar = '/uploads/rentpic/' . $rent->id . '/thumbs/' . $rent->cover->file;
		    } elseif (($rent->photos) && ($rent->photos[0]->file)) {
			$mapavatar = '/uploads/rentpic/' . $rent->id . '/thumbs/' . $rent->photos[0]->file . '';
		    } else {
			$mapavatar = $this->getAssetsUrl() . '/images/nophoto.png';
		    }

		    $description =(isset($rent->descriptions[0])) ? $rent->descriptions[0] :
			    RentDescription::model()->findByPk(array(
				'rent' => $rent->id,
				'language' => '1'
			    )); 

		    $trow['geoX'] = $rent->adress->geox;
		    $trow['geoY'] = $rent->adress->geoy;
		    $trow['title'] = $description->name;
		    $trow['link'] = "/rent/$rent->id";
		    $trow['avatar'] = $mapavatar;
		    $trow['price'] = $tprice;
		    $trow['shortname'] = Yii::t('default', $this->currentCurrency->short_name);
		    $trow['cur_row'] = Yii::t('default', $prices_to_view[$rent->current_price]['row']);
		    $arrayToJson[]=$trow;
		}
		
		print_r(json_encode($arrayToJson));
	    } else 
	    $this->renderPartial('searchresult', array(
		'rents' => $rents, 
		'pages' => $pagination,
		'prices_to_view' => $prices_to_view,
		'count' => $count,
		'pricemin'=>$price['min'],
		'pricemax'=>$price['max'],
		'squaremin'=>$squares['min'],
		'squaremax'=>$squares['max'],
                'top'=>$top,
		'priced'=>$priced,
		'top'=>$top,
		'text'=>false));
	} else { //иначе возвращаем всю страницу
	    $neighborsList = Neighbor::model()->cache(Yii::app()->params['cachetime'])->findAll(); //список соседей
	    $amenitiesList = Amenity::model()->cache(Yii::app()->params['cachetime'])->findAll();   //список удобств
	    $typesArray = $this->modelsNamestoArray(Type::model()->cache(Yii::app()->params['cachetime'])
			    ->findAll());  //массив значений для типов аренды
	    $todoArray = $this->modelsNamestoArray(Todo::model()->cache(Yii::app()->params['cachetime'])
			    ->findAll());   //массив значений для действий аренды	    
	    
	    $cityList =  SearchEngine::engine()->getNetsedItemsByLevel(2,  Yii::app()->language);//список городов
	    //SEO block
	    $this->pageTitle = Yii::t('SEO', 'search.title');
	    Yii::app()->clientScript->registerMetaTag(Yii::t('SEO', 'search.description'), 'description');
	    Yii::app()->clientScript->registerMetaTag(Yii::t('SEO','search.keywords'), 'keywords');
	    // end SEO Block
	    $this->assignAndRender('search', array(
		'searchForm' => $searchForm, //форма поиска
		'rents' => $rents, //список найденных ранее аренд
		'amenities' => $amenitiesList, //перечень удобств(в виде массива)
		'neighbors' => $neighborsList, //перечень соседей
		'Types' => $typesArray, //перечень типов
		'Todos' => $todoArray, //перечень действий
		'Prices' => $price, //минимальное и максимальное значение цены
		'Squares' => $squares, //минимальное и максимальное значение площади
		'pages' => $pagination, //пагинация
		'prices_to_view' => $prices_to_view, //массив отображений цен
		'prices_to_checkbox' => $prices_to_checkbox, //массив выбора цен для чекбокс инпута
		'count' => $count, //обсчий счёт найденых аренд
		'cityList' => $cityList,
		'pricemin'=>$price['min'], 'pricemax'=>$price['max'], 'squaremin'=>$squares['min'], 'squaremax'=>$squares['max'],
		'priced'=>$priced,  //тип вывода цен
		'orderList'=>$orderList,
		'allprices'=>$allprices,
                 'top'=>$top,
		'text'=>false
	    ));
	}
    }

    
        /**
     * подключение необходимых файлов и рендер
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params) {
	$this->assignYandexMap();
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
	    'somefunctions.js',
	    'jquery.imagetick.js',
	    'SearchRadioTodo.js',
	    'cusel.js',
	    'jquery.multi-accordion-1.5.3.js',
	    'accordion_no.js',
	    'MRAjaxLibrary.js',
                    'search_sort.js',
'searchMap2.js',
                    'resetFilters.js',                    'jquery.fancybox.js',
                    'jquery.keyboard.js',
		    'upScript.js' //скрипт для апов
		)
	);
	
	$this->render($view, $params);
    }
    
}

?>
