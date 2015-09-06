<?php

Yii::import('application.controllers.SearchController');

class PresetSearchController extends SearchController {

    public function actionSearch($city = 'odessa', $todo = false, $type = false, $room_count = false) {
	$top = Rent::model()->with(array('photos', 'adress','currency',
			    'descriptions' => array(
				'select' => 'name',
				'params' => array(':lang' => $this->curlang->id),
				'joinType' => 'LEFT OUTER JOIN ',
				'on' => '`descriptions`.`language`=:lang'),
			'top'
			))->findAllByPk(TopFunc::init()->getTopIds(),array('condition'=>'`is_deleted` <> 1 AND in_show=1',
			    'order'=>'`top`.`start` DESC'));
	//предопределение переменных
	$Cityes = Yii::app()->params['CityesUrl'];
	$Todos = Yii::app()->params['TodoUrl'];
	$Types = Yii::app()->params['TypeUrl'];
	$Rooms = Yii::app()->params['RoomsUrl'];

	//если все параметры указаны верно
	$url = rtrim(preg_replace( "/(\/[a-z]{2}\/)$/",'/', Yii::app()->request->requestUri), '/');
	    $urlcount = count(explode('/', ltrim($url,'/')));
	$links = $this->createSeoLinks($urlcount);


	if (isset($Cityes[$city]) && (!$todo||isset($Todos[$todo])) && (!$type||isset($Types[$type])) && (!$room_count || isset($Rooms[$room_count]))) {
	    $searchForm = new SearchForm();  //модель поисковой формы
	    $language = $this->curlang;
	    $squares = Yii::app()->params['squares'];
	    $price = ($todo&&$Todos[$todo]==1)
		? Yii::app()->params['prices']
		 : Yii::app()->params['prices_sale'];
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
	    foreach (Yii::app()->params['order_rows'] as $key => $value) {
		$orderList[$key] = Yii::t('default', $value);
	    }
	    
	  //  $url = rtrim($_SERVER['REQUEST_URI'], '/');

	    $text = SeoPage::model()->findByPk(array(
		'url' => $url,
		'lang' => $language->id
		    ));
	    if (!$text)
		$text = SeoPage::model()->findByPk(array(
		    'url' => $url,
		    'lang' => 1
			));
	//    if ($text) {
	//	$this->pageTitle = $text->title;
	//	Yii::app()->clientScript->registerMetaTag($text->description, 'description');
	//	Yii::app()->clientScript->registerMetaTag($text->keywords, 'keywords');
	  //  }

	    $searchForm->rooms_count = ($room_count) ? array($Rooms[$room_count]) : $searchForm->rooms_count;
	    $searchForm->city = $Cityes[$city];

	    if($todo) $searchForm->todo = $Todos[$todo];
	    if($type) $searchForm->type = $Types[$type];
	    $searchForm->pricemin = $price['min'];
	    $searchForm->pricemax = $price['max'];
	    $searchForm->squaremax = $squares['max'];
	    $searchForm->squaremin = $squares['min'];

	    // ищем аренды по данным из формы
	    $result = SearchEngine::engine()->setParams($searchForm, $language, $price, $squares)
		    ->searchRents();

	    /** получение списка найденных аренд и пагинации  */
	    $rents = $result['rents'];
	    $pagination = $result['pagination'];
	    $count = $result['count'];

	    $priced = false;

	    $neighborsList = Neighbor::model()->cache(Yii::app()->params['cachetime'])->findAll(); //список соседей
	    $amenitiesList = Amenity::model()->cache(Yii::app()->params['cachetime'])->findAll();   //список удобств
	    $typesArray = $this->modelsNamestoArray(Type::model()->cache(Yii::app()->params['cachetime'])
			    ->findAll());  //массив значений для типов аренды
	    $todoArray = $this->modelsNamestoArray(Todo::model()->cache(Yii::app()->params['cachetime'])
			    ->findAll());   //массив значений для действий аренды	    

	    $cityList =  SearchEngine::engine()->getNetsedItemsByLevel(2); //список городов
	    
	    /*Сео*/
	    $seo = $this->getSeo($city , $todo , $type , $room_count);
	    $this->pageTitle=$seo['title'];
	    Yii::app()->clientScript->registerMetaTag($seo['description'], 'description');
	    Yii::app()->clientScript->registerMetaTag($seo['keywords'], 'keywords');
	    
	    
	    $this->assignAndRender('//search/search', array(
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
		'pricemin' => $price['min'], 'pricemax' => $price['max'], 'squaremin' => $squares['min'], 'squaremax' => $squares['max'],
		'priced' => $priced, //тип вывода цен
		'orderList' => $orderList,
		'allprices'=>$allprices,
		'text' => $text,
		'bcrumbs'=>true,
                    'top'=>$top,
		'seolinks'=>$links,
		'h1'=>$seo['h1'],
	    ));
	} else {
	    throw new CHttpException(404, 'page not found');
	}
    }
    
    protected function getSeo($city = 'odessa', $todo = false, $type = false, $room_count = false){
	
	$adder = '.';
	if($todo) $adder.= $todo.'.';
	if($type) $adder .= $type.'.';
	if($room_count&&$type=='flat') $adder .= $room_count.'.';
	
	
	$return = array('title'=>'','description'=>'','keywords'=>'',$h1='');
	$params = array(
	    '#city_pp#'=>Yii::t('casedWords',$city.'.pp'),
	    '#city_rp#'=>Yii::t('casedWords',$city.'.rp'),
	    '#city_ip#'=>Yii::t('casedWords',$city.'.ip')
		);
	    $return['title']=Yii::t('SEO','preset.city'.$adder.'title',$params);
	    $return['description']=Yii::t('SEO','preset.city'.$adder.'description',$params);
	    $return['keywords']=Yii::t('SEO','preset.city'.$adder.'keywords',$params);
	    $return['h1']=Yii::t('SEO','preset.city'.$adder.'h1',$params);
	
	return $return;
    }
    
}

