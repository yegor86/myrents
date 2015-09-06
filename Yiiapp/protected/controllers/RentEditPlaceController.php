<?php
Yii::import('application.controllers.RentEditMainController');
class RentEditPlaceController extends RentEditMainController {

    /**
     * Редактирование адреса
     * @param int $id 
     */
    public function actionEdit($id = 0) {
	$rent = Rent::model()->with('renter', 'adress')->findByPk($id);
	if ($rent) {
	    $hasgeo = true;
	    $adressform = new AdressForm();
	    if (!$rent->adress) {  //если адреса ещё не существует, то добавляем его
		$rent->adress = new Adress();
		$hasgeo = FALSE;
		$rent->adress->rent_id = $rent->id;
		// $rent->adress->save();
	    }
	    if (isset($_POST['AdressForm'])) {  //если была форма запроса
		$this->applyParamsAndSave($rent, $adressform, $hasgeo);
	    } else {  //если формы с изменёнными данными небыло, то восстанавливаем из адреса
		$adressform->adress_prefix = Yii::app()->params['AdressPrefix'];
		$adressform->adress_name = str_replace($adressform->adress_prefix, '', $rent->adress->name);

		$adressform->geopoint = $rent->adress->geox . ',' . $rent->adress->geoy;
	    }

	    $this->assignAndRender('edit', array('rent' => $rent, 'addrform' => $adressform, 'hasgeo' => $hasgeo));
	} else
	    throw new CHttpException(404, 'page not found');
    }

    /**
     * применение параметров, валидация и сохранение
     * @param type $rent
     * @param type $adressform 
     */
    private function applyParamsAndSave($rent, $adressform, &$hasgeo) {
	$adressform->attributes = $_POST['AdressForm'];  //заносим полученные данные в модель формы
	if ($adressform->validate()) {	//проверяем форму
	    $hasgeo = $_POST['hasgeo'];
	    //если форма валидна, заносим данные в аренду
	    Yii::import('application.extensions.Text_LanguageDetect.Text.LanguageDetect');
	    //выявляем локаль введённого адреса
	    $l = new LanguageDetect();
	    $detected = $l->MRdetect($adressform->adress_name); //проверка ввода языка
	    //записываем недостающий адрес (если ввёден нарусском, то англ, если введён англ то переводим на русский)
	    if ($detected == 'ru') {
		$rent->adress->name = $adressform->adress_name; //к адрес полученому из формы добавляем префикс
		$rent->adress->name_en = Yii::app()->bing->translate($rent->adress->name);
	    } else {
		$rent->adress->name_en = $adressform->adress_name; //к адрес полученому из формы добавляем префикс	
		$rent->adress->name = Yii::app()->bing->translate($rent->adress->name_en,'en','ru');
	    }


	    $geopoint = explode(',', $adressform->geopoint);
	    if ($hasgeo) { //если адрес задан
		$rent->adress->geox = $geopoint[0];
		$rent->adress->geoy = $geopoint[1];
	    } else {//если геокоординаты не указаны - ищем самостоятельно
		$params = array(
		    'geocode' => $rent->adress->name, // адрес
		    'format' => 'json', 'results' => 1, 'key' => Yii::app()->params['yandexKey'],
		);
		$response = json_decode(file_get_contents('http://geocode-maps.yandex.ru/1.x/?' . http_build_query($params, '', '&')));
		if ($response->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found > 0) {
		    $geopoint = explode(' ', $response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos);
		    $rent->adress->geox = $geopoint[0];
		    $rent->adress->geoy = $geopoint[1];
		}
	    }
	    //проверяем адрес, если всё нормально, то сохраняем
	    if ($rent->adress->validate()) {
		$rent->adress->save();
		$hasgeo = true;
	    }
	    Yii::app()->user->setFlash('success', Yii::t('default', 'flash.bill.saved'));   //добавляем сообщение об успешном сохранении
	    if (isset($_POST['newdoc']) && ($_POST['newdoc']))
		$this->redirect($_POST['newdoc']);	//если есть переход на другую страницу - переходим
	    else
		$this->refresh();
	}
	else
	    Yii::app()->user->setFlash('error', Yii::t('default', 'mesage.not.saved'));   //добавляем сообщение об неуспешном сохранении
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
	    'cusel.css',
	    'jquery.fancybox.css'
		), array(
	    'menu.js',
	    'jquery.tipTip.js',
	    'jquery.jscrollpane.min.js',
	    'jScrollPaneSelect.js',
	    'jquery-ui-1.8.16.custom.min.js',
	    'somefunctions.js',
	    'jquery.imagetick.js',
	    'edit.js',
	    'cusel.js',
	    'charCount.js',
	    'jquery.fancybox.js',
                 //   'upScript.js' //скрипт для апов
		)
	);
	$this->render($view, $params);
    }

}

?>
