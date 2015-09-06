<?php

class SearchEngine {

    /**
     * $width - связанные с выбираемыми арендами данные
     * $conditions - массив условий поиска
     * $joins - параметры join
     */
    private $with = array('currency');
    private $conditions = array('`in_show` = 1 AND `is_deleted` <> 1');
    private $joins = array();
    private $params = array();
    private $langId = false;
    private $SearchParams = array();
    private $prices = array();
    private $squares = array();
    private $_count = 0;
    private $_order = '`t`.`last_up` DESC';
    private $_sphinx_result_condition = false;
    private $_addressOn =false;
    static function engine() {
	$return = new SearchEngine();
	return $return;
    }

    /**
     * уcтановка параметров
     * @param type $searchForm
     * @param type $language
     * @param type $prices
     * @param type $squares
     * @return \SearchEngine 
     */
    public function setParams($searchForm, $language, $prices, $squares) {
	$this->langId = $language->id;
	$this->SearchParams = $searchForm->attributes;
	$this->prices = $prices;
	$this->squares = $squares;

	$this->addBaseParamsToCriteria();
	$this->addParamsToCriteriaByPrices();
	$this->addparamsToCriteriaBySquare();
	$this->addParamsByRoomsCount();
	$this->addParamsByFloor();
	$this->addParamsByAmenities();
	$this->addParammsByNeighboard();
	$this->addParamsByTextString();
	$this->addParamsByPhoto();
	$this->addOrderParams();
	$this->addRadiusParams();
	return $this;
    }

    public function getNetsedItemsByLevel($level = 2,$lang='ru') {
	$rowname = ($lang=='en')?'name_en':'name';
	$list = Yii::app()->db->createCommand()
		->select(" id, $rowname as  name, geoy, geox")
		->from('address_tree')
		->where('level=:level', array(':level' => $level))
		->order('lft')
		->queryAll();
	return $list;
    }

    /**
     * поиск соседних аренд
     * 
     * @param type $rent
     * @return type 
     */
    public function getSimilar($rent) {
	$squareSimilarRents = array();
	/* поиск близлежащих аренд */
	if ($rent->adress) {
	    //вычисляем диапазон координат поиска
	    $coords = array(
		':minx' => $rent->adress->geox - Yii::app()->params['cornerRadius'],
		':maxx' => $rent->adress->geox + Yii::app()->params['cornerRadius'],
		':miny' => $rent->adress->geoy - Yii::app()->params['cornerRadius'],
		':maxy' => $rent->adress->geoy + Yii::app()->params['cornerRadius'],
	    );
	    //находим аренды в квадрате +- от полученной аренды
	    //того-же типа
	    $hasPhotos = $this->getHasPhotos();
	    $photosCondition = (count($hasPhotos)) ? 'AND `in_show`=1 AND (`t`.`id` IN(' . implode(',', $hasPhotos) . '))' : ' AND `in_show`=1 ';
	    $squareSimilarRents = Rent::model()->with(
			    array(
				'photos',
				'adress' => array(
				    'condition' => '(`adress`.`geox` BETWEEN :minx AND :maxx) 
					AND (`adress`.`geoy` BETWEEN :miny AND :maxy)',
				    'params' => $coords
				)
			    )
		    )->findAll(array(
		'limit' => Yii::app()->params['maxsimilar'],
		'condition' => '(`t`.`todo` = :todo) AND (`t`.`id` <> :selfid) '
		. $photosCondition
		. '   AND (`t`.`in_show` = 1 AND `t`.`is_deleted` <> 1)',
		'params' => array(':todo' => $rent->todo, ':selfid' => $rent->id)
		    ));
	}
	// преобразуем в удобочитаемый формат
	$similarRents = $this->similarToAsoc($squareSimilarRents, $rent);
	return $similarRents;
    }

    /**
     * фильтруем диаметр и сортируем в ассоциативном массиве
     * @param type $squareSimilarRents
     * @return type 
     */
    private function similarToAsoc($squareSimilarRents, $rent) {
	$similarRents = array();   //тут будут хранится близлежащие аренды
	$EARTH_RADIUS = 6.371032;  //радиус земли в тысячах километров, впринципе можно не дефайнить 
	//вряд-ли он ближайшее будущее изменится	
	//перелистываем получанные аренды, и высчитываем расстояние до текущей
	foreach ($squareSimilarRents as $similarRent) {
	    $p1 = array('x' => $similarRent->adress->geox, 'y' => $similarRent->adress->geox);
	    $p2 = array('x' => $rent->adress->geox, 'y' => $rent->adress->geoy);
	    $r1 = array('x' => $p1['x'] * M_PI / 180, 'y' => $p1['y'] * M_PI / 180);
	    $r2 = array('x' => $p2['x'] * M_PI / 180, 'y' => $p2['y'] * M_PI / 180);
	    $distance = round(acos(sin($r1['y']) * sin($r2['y']) +
			    cos($r1['y']) * cos($r2['y']) * cos(abs($r1['x'] - $r2['x']))) * $EARTH_RADIUS, 3);
	    if ($distance <= Yii::app()->params['kilometerSimilarRadius']) {
		$similarRents[] = array('rent' => $similarRent, 'distance' => $distance);
	    }
	}
	ksort($similarRents);
	return $similarRents;
    }

    
    public function searchRents(){
	$result = $this->singleSearchRents();
	if(!$this->_count) {$this->addParamsByTextString(true);
	$result = $this->singleSearchRents();}
	return $result;
    }
    
    //поиск
    public function singleSearchRents() {
	$subcondition = $this->conditions;
	if($this->_sphinx_result_condition) $subcondition[] = $this->_sphinx_result_condition;
	$rents = array();
	//$this->_addressOn=false;
	$this->with['adress'] =($this->_addressOn)?$this->_addressOn:array('joinType' => 'INNER JOIN');

	$criteria = new CDbCriteria(
			array(
			    'condition' => implode(' AND ', $subcondition),
			    'params' => $this->params,
			    'join' => implode(' ', $this->joins),
			    'with' => $this->with,
			    'order' => $this->_order,
		));
	//применяем пагинацию
	$perpage = (!isset($this->SearchParams['mapsearch'])||(!$this->SearchParams['mapsearch']))?
	Yii::app()->params['resultsPerPage']:
	    Yii::app()->params['rentsOnMap'];
	$pagination = $this->paginateByCriteria($criteria,$perpage);
	//добавляем в запрос width
	$this->with += array(
	    'photos',
	    'renter',
	    'amenities',
	);
	$criteria->with = $this->with;
	//print_r($criteria->with['adress']);
	$rents = Rent::model()->texted($this->langId)->findAll($criteria);
	return array('rents' => $rents, 'pagination' => $pagination, 'count' => $this->_count);
    }

    private function paginateByCriteria($criteria, $perpage = false) {
	$this->_count = Rent::model()->count($criteria);
	$pagesize = ($perpage)?$perpage:Yii::app()->params['resultsPerPage'];
	$pagination = new CPagination($this->_count);
	$pagination->setPageSize($pagesize);
	$pagination->pageVar = 'page';
	$pagination->applyLimit($criteria);
	return $pagination;
    }

    /**
     * функции добавления параметров в поиск, вынесены каждая отдельно ради удобочитаемости
     * @param type $searchForm 
     */
    private function addBaseParamsToCriteria() {
	//базовые параметры поиска (участвуют всегда) 
	if(isset($this->SearchParams['type'])&&$this->SearchParams['type']){
	    $this->params[':type'] = $this->SearchParams['type'];
	    $this->conditions[]='`type` = :type';
	}
	if(isset($this->SearchParams['todo'])&&$this->SearchParams['todo']){
	    $this->params[':todo'] = $this->SearchParams['todo'];
	    $this->conditions[]= '`todo` = :todo';
	}
    }

    private function addRadiusParams(){
	if(isset($this->SearchParams['mapsearch'])&&(isset($this->SearchParams['radius']))
		&&(isset($this->SearchParams['coords']))
		&&$this->SearchParams['coords']&&$this->SearchParams['coords']!='0, 0'&&$this->SearchParams['radius']&&$this->SearchParams['mapsearch']
		){
	    $coords = explode(',', $this->SearchParams['coords']);
	    $radius = $this->SearchParams['radius'];	    
	    
	    $rcoords = array(
		':minx' =>  $coords[0] - $radius/(1500*69),
		':maxx' => $coords[0] + $radius/(1500*69),
		':miny' => $coords[1] - $radius/(1500*100),
		':maxy' => $coords[1] + $radius/(1500*100),
	    );
	    $this->_addressOn =
		    array( 'condition'=>'(`adress`.`geoX` BETWEEN :minx AND :maxx) AND ( `adress`.`geoY` BETWEEN  :miny AND :maxy)',
			'params'=>$rcoords, 'joinType' => 'INNER JOIN');
	}
    }
    
    private function textSearch($searchStep=0){
	$noSearchWords = require dirname(__FILE__) . '/../config/nosearchwords.php';
	$searchText =($this->SearchParams['searchString'])?preg_replace($noSearchWords, array(), $this->SearchParams['searchString']):'';
	$searchCity =($this->SearchParams['city']||$this->SearchParams['region'])? preg_replace($noSearchWords, array(), $this->SearchParams['city'] .', '. $this->SearchParams['region']):'';
		    $rents_ids = false;
	    if($searchText||$searchCity){
	    //разбиваем поисковую строку поиска на слова (заодно опуская лишние символы)
	    preg_match_all('/([-a-zа-я\d\\\]+)/iu', $searchText, $regexp_matches);
	    
	    //конкатенируем слова в строку для запроса, с разделителем и\или (зависит от условия поиска)
	    // добавляем звёздочки в начало и конец каждого слова (для поиска по части слова)
	    switch ( $searchStep){
		case 1: array_pop($regexp_matches[1]);
		case 0: $implodeSymbol = ' , ';break;
		case 2: $implodeSymbol = ' | ';break;
		
	    }
            
            if($searchText){
                $tempText = array();
                foreach ($regexp_matches[1] as $world){
                    $tempText[] = "($world | *$world* )"; 
                }
                $searchText = implode($implodeSymbol,$tempText);
            } else $searchText = '';
	    
	    //разбиваем строку с городами на слова (заодно опуская лишние символы)
	    preg_match_all('/([a-zа-я\d]+)/iu', $searchCity, $regexp_matches);
	    //конкатенируем найденные слова (без звёздочек) в строку с нужным разделителем
	    $searchCity = implode(' , ',$regexp_matches[1]);
	    unset ($regexp_matches);$rowname = 'adress';
	    if(!$searchCity&&!$searchText) return false;
	    //выясняем по какому полю будем искать, подготавливаем поиск
	    if($searchCity){
		    Yii::import('application.extensions.Text_LanguageDetect.Text.LanguageDetect');
		    $l=new LanguageDetect();
		    $detected = $l->MRdetect($searchCity); //проверка ввода языка
		    		    if($detected == 'en') $rowname='adress_en';
		   else $rowname = 'adress';
	    }	    
	    if($searchText&&$searchCity){
		$searchQuery = 
		'(@'.$rowname.' '. $searchCity. ')|'.$searchText;
		//в $rowname лежит поле адреса, по которому ищем город (бывает adresss или  adress_en  в зависимости от локали)
		//(@adress список_поля_городов) | (поисковый текст) ищёт собпадение указанных в поле городах или по текстовой строке по всем полям
		
	    }elseif($searchText){
		//если указан только поиск по текстовой строке - ищем указанную строку по всем полям
		$searchQuery = $searchText;
	    }else
		//если поиск только по гоороду, ищем только по полю адреса
		$searchQuery = '(@'.$rowname.' '. $searchCity. ')';
	    //собрали строку поиска, теперь выполняем запрос
	    $rentslist = Yii::App()->search->select('id')->from('rents')->
			    where($searchQuery)->searchRaw();
	    $rents_ids = array_keys($rentslist['matches']);
	    if (empty($rents_ids)&&$searchStep<2){
		$rents_ids = $this->textSearch($searchStep+1);
	    }elseif(empty($rents_ids)){
		$rents_ids = array(0);
	    }
		//если ничего небыло найдено
	}
	return $rents_ids;
    }
        
    
    private function addParamsByTextString($or = false) {
	$rents_ids = $this->textSearch();
	if(is_array($rents_ids)){
	    $this->_sphinx_result_condition = '`t`.`id` IN (' . implode(',', $rents_ids) . ')';
	}
    }


    
    public function getHasPhotos() {

	//TODO: кеш выключен, при большем количестве аренд нужно включить
	/* $value = Yii::app()->cache->get('hasPhotoArray');
	  if ($value === false) {
	  $value = array();
	  $sqlResult = Yii::app()->db
	  ->createCommand('SELECT Photo.rent FROM Photo GROUP BY rent;')
	  ->queryAll();
	  foreach ($sqlResult as $RentHasPhoto) {
	  $value[] = $RentHasPhoto['rent'];
	  }

	  Yii::app()->cache->set('hasPhotoArray', $value,Yii::app()->params['cachetime']);
	  } */
	$value = array();
	$sqlResult = Yii::app()->db
		->createCommand('SELECT Photo.rent FROM Photo GROUP BY rent;')
		->queryAll();
	foreach ($sqlResult as $RentHasPhoto) {
	    $value[] = $RentHasPhoto['rent'];
	}


	return $value;
    }

    private function addParamsByPhoto() {
	//если стоит галка "только с фото", то обязательное вхождение фото в поиск
	if ($this->SearchParams['justwithphotos']) {
	    $photosBills = $this->getHasPhotos();
	    if (count($photosBills))
		$this->conditions[] = '`t`.`id` IN(' . implode(',', $photosBills) . ')';
	}
    }

    private function addParammsByNeighboard() {
	//если в поиске учатсвуют соседи, добавляем в запрос
	if (count($this->SearchParams['neiborhood'])) {
	    $this->conditions[] = ' (`t`.`neiborhood_bitmask` & :neiborhoodbitmask) >= :neiborhoodbitmask ';
	    $this->params[':neiborhoodbitmask'] = BitMask::ArrToIntBitMask($this->SearchParams['neiborhood']);
	}
    }

    private function addParamsByAmenities() {
	//если в поиске учатсвуют услуги, добавляем в запрос
	if (count($this->SearchParams['amenities'])) {
	    $this->conditions[] = ' (`t`.`amenity_bitmask` & :amenitybitmask) >= :amenitybitmask ';
	    $this->params[':amenitybitmask'] = BitMask::ArrToIntBitMask($this->SearchParams['amenities']);
	}
    }

    private function addParamsByFloor() {
	//если в поиске участвует выбор этажей, и он не максимален, включаем этажи в поиск
	if ($this->SearchParams['floor']) {
	    $this->conditions[] = '`t`.`floor`' . Yii::app()->params['floors_search_queries'][$this->SearchParams['floor']];
	}
    }

    private function addParamsByRoomsCount() {
	//если в поиске участвует выбор комнат, и он не максимален, включаем комнаты в поиск
	if (isset($this->SearchParams['rooms_count'])) {
	    $countroom = count($this->SearchParams['rooms_count']);
	    if ($countroom != 0 && $countroom != 5) {
		//поскольку в форме нет валидатора массива целых чисел, то безопасности ради рекурсивно приводим тип к integer
		$this->SearchParams['rooms_count'] =
			CustomFunctions::recursiveValuesToType($this->SearchParams['rooms_count'], 'integer');
		$this->conditions[] = '`rooms_count` IN (' . implode(',', $this->SearchParams['rooms_count']) . ')';
	    }
	}
    }

    private function addparamsToCriteriaBySquare() {
	//если диапазон площадей отличается от максимального, включаем в поиск
	if (($this->SearchParams['squaremin'] != $this->squares['min']) || ($this->SearchParams['squaremax'] != $this->squares['max'])) {
	    $this->conditions[] = '`square` BETWEEN :squaremin AND :squaremax';
	    $this->params[':squaremin'] = $this->SearchParams['squaremin'];
	    $this->params[':squaremax'] = $this->SearchParams['squaremax'];
	}
    }

    private function addOrderParams() {
	if ($this->SearchParams['order'] == 'price') {
	    if ($this->SearchParams['current_price']) {
		$this->_order = '`t`.`index_' . Yii::app()->params['current_price'][$this->SearchParams['current_price']]['row'] . '`';
	    }
	    else
		$this->_order = '(CASE  `current_price` 
		   WHEN 1 THEN `index_price_day`
		   WHEN 2 THEN `index_price_week`
		   WHEN 3 THEN `index_price_month`
		   END)'
		;
	}else {
	    $this->_order = '`t`.`last_up` ';
	}
	$this->_order .= ($this->SearchParams['asc']) ? 'ASC ' : 'DESC';
    }

    private function addParamsToCriteriaByPrices() {
	//если диапазон цен отличается от максимального, включаем в поиск
	$currency = $this->prices['currency'];
	if (($this->SearchParams['pricemin'] != $this->prices['min']) || ($this->SearchParams['pricemax'] != $this->prices['max'])) {

	    $between = ($this->SearchParams['pricemax'] != $this->prices['max']) ? true : false;

	    if ($this->SearchParams['current_price']) {
		$row = Yii::app()->params['current_price'][$this->SearchParams['current_price']]['row'];
		if ($between) {
		    $this->conditions[] = "`$row` BETWEEN (:pricemin/`currency`.`rate`) AND (:pricemax/`currency`.`rate`)";
		    $this->params[':pricemin'] = $this->SearchParams['pricemin'] * $currency;
		    $this->params[':pricemax'] = $this->SearchParams['pricemax'] * $currency;
		} else {
		    $this->conditions[] = "`$row` >= :pricemin";
		    $this->params[':pricemin'] = $this->SearchParams['pricemin'] * $currency;
		}
	    } else {
		$newcond = '
		   (CASE  `current_price` 
		   WHEN 1 THEN `price_day`
		   WHEN 2 THEN `price_week`
		   WHEN 3 THEN `price_month`
		   END) ';
		if ($between) {
		    $newcond .= 'BETWEEN  (:pricemin/`currency`.`rate`) AND (:pricemax/`currency`.`rate`)';
		    $this->params[':pricemin'] = $this->SearchParams['pricemin'] * $currency;
		    $this->params[':pricemax'] = $this->SearchParams['pricemax'] * $currency;
		} else {
		    $newcond .= '>= :pricemin';
		    $this->params[':pricemin'] = $this->SearchParams['pricemin'] * $currency;
		}
		$this->conditions[] = $newcond;
	    }
	} elseif ($this->SearchParams['current_price']) {
	    $row = Yii::app()->params['current_price'][$this->SearchParams['current_price']]['row'];
	    $this->conditions[] = "`$row` >= :pricemin";
	    $this->params[':pricemin'] = 1;
	} else {
	    $this->conditions[] = '(CASE  `current_price` 
		   WHEN 1 THEN `price_day`
		   WHEN 2 THEN `price_week`
		   WHEN 3 THEN `price_month`
		   END) ' . '>= :pricemin';
	    $this->params[':pricemin'] = 1;
	}
    }

}

?>
