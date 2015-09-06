<?php

class ApiXmlExec {
    
    private $result = array('status'=>'OK','message'=>'OK');//массив результатов обработки
    
    
    //спрячем конструктор
    private function __construct() {
	
    }

    //конструктор
    static public function xml() {
	return new ApiXmlExec();
    }

    
    /**
     * обработка одной записи
     * @param type $advertisement 
     */
    public function processAd($advertisement) {
	if (isset($advertisement->action)) {
	    switch ((string) $advertisement->action) {
		case 'add' : $this->addAd($advertisement);
		    break;
		case 'edit' : $this->editAd($advertisement);
		    break;
		case 'delete': $this->deleteAd($advertisement);
		    break;
	    }
	}
	return $this->result;
    }

    /**
     * обработка дополнительнеых комманд
     * @param type $xml 
     */
    public function processOther($xml) { //если поступила комманда удалить аренды, не перечисленные в списке
	if (isset($xml->delete_not_listed)) {
	    $this->deleteNotListed($xml);
	}
    }

    private function deleteNotListed($xml) {
	$arrayOfIds = array();	//составляем список аренд, не входящих в состав удаляемых
	if (isset($xml->delete_not_listed->id))
	    foreach ($xml->delete_not_listed->id as $id) {
		$arrayOfIds[] = (int) $id;
	    }

	$criteria = new CDbCriteria();
	$criteria->condition = '`t`.`user` =:user ';
	$criteria->params = array(':user' => Yii::app()->user->id);
	if (count($arrayOfIds)) {
	    $criteria->condition.=' AND `t`.`id` NOT IN (' . implode(',', $arrayOfIds) . ')';
	}
	$rents = Rent::model()->with('photos')->findAll($criteria); //ищем все объявления для удаления
	if ($rents)
	    foreach ($rents as $rent) {
		foreach ($rent->photos as $photo) { //удаляем все файлы картинок
		    $filename = Yii::getPathOfAlias('webroot') . Yii::app()->params['RENTPHOTOSDIR'] . $rent->id . '/' . $photo->file;
		    if (is_file($filename))
			unlink($filename);
		}
	    }
	Rent::model()->deleteAll($criteria); //удаляем все полученные аренды
	return true;
    }

    /**
     * удаление обьявления
     * @param type $advertisement
     * @return массив с результатом 
     */
    public function deleteAd($advertisement) {
	$result = array();
	$worked = Yii::app()->user->getState('apifile');
	$rent = Rent::model()->with('photos')->findByPk((int) $advertisement->id, array('condition' => 'user = :uid', 'params' => array(':uid' => Yii::app()->user->id)));
	if ($rent) {
	    foreach ($rent->photos as $photo) {
		$filename = Yii::getPathOfAlias('webroot') . Yii::app()->params['RENTPHOTOSDIR'] . $rent->id . '/' . $photo->file;
		if (is_file($filename))
		    unlink($filename);
		$photo->delete();
	    }
	    if($rent->delete()) $this->result = array('status'=>'OK', 'message'=> 'Объявление'. $advertisement->id. ' удалено');
	    else $this->result = array('status'=>'Error', 'message' => 'объявление '. $advertisement->id. ' не удалено: Неизвестная ошибка');
	} else $this->result = array('status'=>'Error', 'message' => 'Объявление '. $advertisement->id. ' не удалено: такое объявление не найдено');
	return $this;
    }

    /**
     * добавление аренды
     * @param type $advertisement
     * @return \ApiXmlExec 
     */
    public function addAd($advertisement) {
	$allow = false;
	//перед добавлением проверяем, есть ли текст в русской локали, если оного нет - пропуск
	if (isset($advertisement->text->textpath)) {
	    foreach ($advertisement->text->textpath as $text) {
		$allow = (string) $text->language == 'ru' || $allow;
	    }
	}
	if ($allow) {
	    $rent = new Rent();
	    $rent->user = Yii::app()->user->id;
	    $this->applyParamsAndSave($rent, $advertisement, 'add');
	} else  $this->result = array('status'=>'Error', 'message' => 'Объявление не добавлено: не указано название в русской локали');
	return $this;
    }

    /**
     * редактирование аренды
     * @param type $advertisement
     * @return boolean 
     */
    private function editAd($advertisement) {
	$rent = Rent::model()->findByPk((int) $advertisement->id);
	if ($rent->user == Yii::app()->user->id) {
	    $this->applyParamsAndSave($rent, $advertisement, 'edit');
	}
	return true;
    }

    /**
     * применение параметров и сохранение
     * @param type $rent
     * @param type $advertisement 
     */
    public function applyParamsAndSave($rent, $advertisement, $scenario = 'add') {
	//параметры, доступные до создания объявления
	$this->applyMainParams($rent, $advertisement, $scenario);
	$this->applyPrices($rent, $advertisement, $scenario);
	$this->applyDates($rent, $advertisement, $scenario);
	//далее параметры могут быть применимы только к уже созданнму объявлению
	//по-этому сначала сохраняем само объявление, затем продолжаем парсинг
	if ($rent->save()) {
	    $this->applyAdress($rent, $advertisement, $scenario);
	    $this->applyDesctiptions($rent, $advertisement, $scenario);
	    $this->applyAmenities($rent, $advertisement, $scenario);
	    $this->applyNeighboards($rent, $advertisement, $scenario);
	    $this->applyPhotos($rent, $advertisement, $scenario);
	} else {$this->result=array('status'=>'Error', 'message' => 'Объявление не добавлено: не невалидне основные данные ');
	}
    }

    //////////////Добавление различных параметров одного обьявления////////////

    /**
     * стандартные параметры обьявления
     * @param type $rent
     * @param type $advertisement
     * @param type $scenario
     * @return boolean 
     */
    private function applyMainParams($rent, $advertisement, $scenario = 'add') {
	//добавляем действие
	if (isset($advertisement->maininfo->todo))
	    switch ((string) $advertisement->maininfo->todo) {
		case 'rent':$rent->todo = 1;
		    break;
		case 'sale':$rent->todo = 2;
		    break;
		default:$rent->todo = 1;
	    } else {
	    if ($scenario == 'add')
		$rent->todo = 1;
	}//если не указан и аренда создаётся, указывается по-умолчанию, иначе оставляем как есть
	//добавляем тип
	if (isset($advertisement->maininfo->type))
	    switch ((string) $advertisement->maininfo->type) {
		case 'flat':$rent->type = 1;
		    break;
		case 'house':$rent->type = 2;
		    break;
		case 'office':$rent->type = 3;
		    break;
		default:$rent->type = 1;
	    } else {
	    if ($scenario == 'add')
		$rent->type = 1;
	}
	//площадь
	if (isset($advertisement->maininfo->square))
	    $rent->square = (int) $advertisement->maininfo->square;
	elseif ($scenario == 'add')
	    $rent->square = 1;
	//этаж
	if (isset($advertisement->maininfo->floor))
	    $rent->floor = ((int) $advertisement->maininfo->floor <= 15) ? (int) $advertisement->maininfo->floor : 15;
	elseif ($scenario == 'add')
	    $rent->floor = 1;
	//количество комнат
	if (isset($advertisement->maininfo->rooms))
	    $rent->rooms_count = (int) $advertisement->maininfo->rooms;
            if($rent->rooms_count > 5) $rent->rooms_count=5;
	elseif ($scenario == 'add')
	    $rent->rooms_count = 1;

	return true;
    }

    /**
     * применение цен
     * @param type $rent
     * @param type $advertisement
     * @param type $scenario 
     */
    private function applyPrices($rent, $advertisement, $scenario = 'add') {
	if ($rent->todo != 1) { //если обьявление не об арендеб то цена сохраняется в поле price_day
	    $rent->price_day = (isset($advertisement->pricing->price)) ? (double) $advertisement->pricing->price : 0;
	    $rent->current_price = 1;
	} else {
	    //обьявление об аренде - заполняем все поля и указываем цену по-умолчанию 
	    $rent->price_day = (isset($advertisement->pricing->day)) ? (double) $advertisement->pricing->day : 0;
	    $rent->price_week = (isset($advertisement->pricing->week)) ? (double) $advertisement->pricing->week : 0;
	    $rent->price_month = (isset($advertisement->pricing->month)) ? (double) $advertisement->pricing->month : 0;
	    //выбор цены по-умолчанию
	    if (isset($advertisement->pricing->default))
		switch ((string) $advertisement->pricing->default) {
		    case 'day':$rent->current_price = 1;
			break;
		    case 'week':$rent->current_price = 2;
			break;
		    case 'month':$rent->current_price = 3;
			break;
		    default : $rent->current_price = 1;
		} else
		$rent->current_price = 1;
	}
	//установка валюты
	if (isset($advertisement->pricing->currency)) {
	    $currency = Currency::model()->findByAttributes(array('short_name' => (string) $advertisement->pricing->currency));
	}
	//если валюта не указана или указана неправильно - устанавливаем гривну
	if (!$currency)
	    $currency = Currency::model()->findByPk(1);
	$rent->currency_id = $currency->id;
	//установка индексов цен
	$rent->index_price_day = $rent->price_day * $currency->rate;
	$rent->index_price_week = $rent->price_week * $currency->rate;
	$rent->index_price_month = $rent->price_month * $currency->rate;
	return true;
    }

    /**
     * установка дат
     * @param type $rent
     * @param type $advertisement
     * @param type $scenario 
     */
    private function applyDates($rent, $advertisement, $scenario = 'add') {
	if (isset($advertisement->maininfo->creation_date))
	    $rent->creation_date = date("Y-m-d H:i:s", strtotime($advertisement->maininfo->creation_date));
	else
	    $rent->creation_date = date("Y-m-d H:i:s");
	if ($scenario == 'add'){
	    $rent->last_up = $rent->creation_date;
	}
	$rent->last_modify = date("Y-m-d H:i:s");
	return true;
    }

    /**
     * сохранение описаний
     * @param type $rent
     * @param type $advertisement
     * @param type $scenario 
     */
    private function applyDesctiptions($rent, $advertisement, $scenario = 'add') {
	if (isset($advertisement->text->textpath)) {
	    $descriptions = array();
	    foreach ($advertisement->text->textpath as $text) {
		$language = Language::model()->findByAttributes(array('language' => $text->language));
		$language = ($language) ? $language->id : 1;
		$description = RentDescription::model()->findByPk(array('language' => $language, 'rent' => $rent->id));
		if (!$description)
		    $description = new RentDescription();
		$description->language = $language;
		$description->rent = $rent->id;
		$hasrussian = (string) $text->language == 'ru' || $hasrussian;
		$description->name = (string) $text->title;
		$description->overview = (string) $text->description;
		$description->rules = (string) $text->rules;
		if ($description->validate())
		    $descriptions[] = $description;
	    }
	    $rent->descriptions = $descriptions;
	    $rent->saveDescriptions(true);
	}
	return true;
    }

    /**
     * применение адреса
     * @param type $rent
     * @param type $advertisement
     * @param type $scenario
     * @return boolean 
     */
    private function applyAdress($rent, $advertisement, $scenario = 'add') {
	if (isset($advertisement->address)) {
	    $adress = ($rent->adress) ? $rent->adress : new Adress();
	    $adrarray = array();
	    $adress->rent_id = $rent->id;
	    $onelocation = (isset($advertisement->address->textLocation))?(string)$advertisement->address->textLocation:false;
	    $adrarray = array(
		'country' => (isset($advertisement->address->country)) ? (string) $advertisement->address->country : '',
		'region' => (isset($advertisement->address->region)) ? (string) $advertisement->address->region : '',
		'city' => (isset($advertisement->address->city)) ? (string) $advertisement->address->city : '',
		'area' => (isset($advertisement->address->area)) ? (string) $advertisement->address->area : '',
		'street' => (isset($advertisement->address->street)) ? (string) $advertisement->address->street : '',
		'other' => (isset($advertisement->address->other)) ? (string) $advertisement->address->other : '',
	    );
	    $adress->geox = 30.735857;
	    $adress->geoy = 46.469517; //координаты Одессы по умолчанию
	    if (isset($advertisement->address->geopoint)) { //если геопоинт указан - выбираем его
		$adress->geox = (isset($advertisement->address->geopoint->longitude)) ? (double) $advertisement->address->geopoint->longitude : $adress->geox;
		$adress->geoy = (isset($advertisement->address->geopoint->latitude)) ? (double) $advertisement->address->geopoint->latitude : $adress->geoy;
	    } else {  //если геопоинт не указан - определяем через яндекс
		$params = array(
		    'format' => 'json', 'results' => 1, 'key' => Yii::app()->params['yandexKey'],
		);
		$params['geocode'] =($onelocation)?$onelocation:implode(',', $adrarray); // адрес]
		$response = json_decode(file_get_contents('http://geocode-maps.yandex.ru/1.x/?' . http_build_query($params, '', '&')));
		if ($response->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found > 0) {
		    $geo = explode(' ', $response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos);
		    $adress->geox = $geo[0];
		    $adress->geoy = $geo[1];
		}
	    }
	    if (isset($advertisement->address->nosaves->no))
		foreach ($advertisement->address->nosaves->no as $nosave) {
		    unset($adrarray[(string) $nosave]);
		}
	    $adress->name = ($onelocation)?$onelocation:implode(',', $adrarray);
	    $adress->save();
	}
	return true;
    }

    /**
     * сохранение аменитис
     * @param type $rent
     * @param type $advertisement
     * @param type $scenario
     * @return boolean 
     */
    private function applyAmenities($rent, $advertisement, $scenario = 'add') {
	if (isset($advertisement->amenities)) {
	    $newAmenityList = $arrayToBM = array();
	    if (isset($advertisement->amenities->amenity)) {
		$nbIDs = MRChtml::listData(Amenity::model()->cache(Yii::app()->params['cachetime'])->findAll(), 'name', 'id', 'amenity.');
		foreach ($advertisement->amenities->amenity as $comfort) {
			if (isset($nbIDs[(string) $comfort])) {
			    $newAmenityList[] = array('id' => $nbIDs[(string) $comfort]);
			    $arrayToBM[] = $nbIDs[(string) $comfort];
			}
		}
	    }
	    $rent->amenity_bitmask = BitMask::ArrToIntBitMask($arrayToBM);
	    $rent->setRelationRecords('amenities', $newAmenityList);
	    $rent->save();
	}
	return true;
    }

    /**
     * сохранение соседей
     * @param type $rent
     * @param type $advertisement
     * @param type $scenario 
     */
    private function applyNeighboards($rent, $advertisement, $scenario = 'add') {
	if (isset($advertisement->neighbors)) {
	    $newNeighborsList = $arrayToBM = array();
	    if (isset($advertisement->neighbors->neighbor)) {
		$nbIDs = MRChtml::listData(Neighbor::model()->cache(Yii::app()->params['cachetime'])->findAll(), 'name', 'id', 'neighbor.');
		foreach ($advertisement->neighbors->neighbor as $neighbor) {
		    if (isset($nbIDs[(string) $neighbor])) {
			$newNeighborsList[] = array('id' => $nbIDs[(string) $neighbor]);
			$arrayToBM[] = $nbIDs[(string) $neighbor];
		    }
		}
		$rent->neiborhood_bitmask = BitMask::ArrToIntBitMask($arrayToBM);
		$rent->setRelationRecords('neighbors', $newNeighborsList);
		$rent->save();
	    }
	}
	return true;
    }

    private function applyPhotos($rent, $advertisement, $scenario = 'add') {
	//если есть запрос на изменение фото, то удаляем сначала имеющиеся
	if (isset($advertisement->photos)) {
	    foreach ($rent->photos as $photo) {
		$filename = Yii::getPathOfAlias('webroot') . Yii::app()->params['RENTPHOTOSDIR'] . $rent->id . '/' . $photo->file;
		if (is_file($filename))
		    unlink($filename);
		$photo->delete();
	    }
	}
	//потом скачиваем новые
	if (isset($advertisement->photos->photo)) {
	    foreach ($advertisement->photos->photo as $photoUrl) {
		$downloadedPhoto = new FileFromUrl((string) $photoUrl);
		$filename = CustomFunctions::translit($downloadedPhoto->getName());

		$filename = ImageProcessing::image()
			->saveImage($downloadedPhoto, $filename, array(
		    'watermark' => true,
		    'watermark_pic' => Yii::getPathOfAlias('webroot') . '/' . Yii::app()->params['watermark']['image'],
		    'watermark_x' => Yii::app()->params['watermark']['x'],
		    'watermark_y' => Yii::app()->params['watermark']['y'],
		    'watermark_corner' => Yii::app()->params['watermark']['corner'],
		    'width' => 650,
		    'height' => 450,
		    'maindir' => Yii::app()->params['RENTPHOTOSDIR'] . $rent->id . '/',
		    'thumb' => array(array(
			    'height' => 105,
			    'resizeMinimal' => true,
			    'width' => 135,
		    ))));
		$newPhoto = new Photo();
		$newPhoto->rent = $rent->id;
		$newPhoto->file = $filename;
		$newPhoto->save();
	    }
	}
	return true;
    }

    //////////////конец добавления различных параметров одного обьявления////////////
}