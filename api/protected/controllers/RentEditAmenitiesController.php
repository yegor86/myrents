<?php
Yii::import('application.controllers.RentEditMainController');
class RentEditAmenitiesController extends RentEditMainController {

    /**
     * создаём массив, состоящий из определённого поля моделей
     * @param CActiveRecord[] $modelsarray
     * @param string $rowtoshow
     * @return String[] 
     */
    private function modelsToArray($modelsarray = array(), $rowtoshow = 'id') {
	$result = array();
	foreach ($modelsarray as $model) {
	    $result[] = $model->$rowtoshow;
	}
	return $result;
    }

    public function actionEdit($id = 0) {
	$rent = Rent::model()->with('amenities', 'renter')->findByPk($id,'`is_deleted` <> 1');
	if ($rent) {
	    		$amenitiesList = Amenity::model()->cache(Yii::app()->params['cachetime'])->findAll();
		if (isset($_POST['Amenity'])) {
		    $this->applyParamsAndSave($rent, $amenitiesList);
		}
		$arrOfRentAmenitiesId = $this->modelsToArray($rent->amenities);	 //массив из IDшников удобств, присутствующих в аренде, нужен для отображения
		$this->assignAndRender('amenitiesEdit', array('rent' => $rent, 'amenities' => $amenitiesList, 'rentamenityarr' => $arrOfRentAmenitiesId));
	} else
	    throw new CHttpException(404, 'page not found');
    }

    /**
     * применение параметров, валидация и сохранение
     * @param Rent $rent
     * @param Amenitie[] $amenitieslist 
     */
    private function applyParamsAndSave($rent, $amenitiesList) {
	$newAmenitieslist = array();
	$arrayToBM = array();
	foreach ($amenitiesList as $key => $amenity) {
	    if (isset($_POST['Amenity'][$key]['id']) && ($_POST['Amenity'][$key]['id'])) {
		$newAmenitieslist[] = array('id' => $amenity->id);
		$arrayToBM[] = $amenity->id;
	    }
	}

	$rent->amenity_bitmask = BitMask::ArrToIntBitMask($arrayToBM);
	$rent->setRelationRecords('amenities', $newAmenitieslist);
	if ($rent->save()) {
	    Yii::app()->user->setFlash('success', Yii::t('default', 'flash.bill.saved'));   //добавляем сообщение об успешном сохранении
	    if (isset($_POST['newdoc']) && ($_POST['newdoc']))
		$this->redirect($_POST['newdoc']);			     //если есть переход на другую страницу - переходим 
	    else $this->refresh ();
	} else
	    Yii::app()->user->setFlash('error', Yii::t('default', 'mesage.not.saved'));   //добавляем сообщение об ошибке
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
	    'somefunctions.js',
	    'jquery.imagetick.js',
	    'edit.js',
	    'cusel.js',
	    'charCount.js','jquery.fancybox.js',
                    'upScript.js' //скрипт для апов
		)
	);
	$this->render($view, $params);
    }

}

?>