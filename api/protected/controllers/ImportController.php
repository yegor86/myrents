<?php
Yii::import('application.controllers.AdminController');
class ImportController extends AdminController {

    /** импорт БД из xml
     * 
     */
    public function actionXml() {
	$view = 'index';
	$step = 1;
	$count = 0;
	$form = new StepExecutionForm();
	$completed = false;
	if (isset($_POST['StepExecutionForm'])) {
	    $form->attributes = $_POST['StepExecutionForm'];
	    if(!is_file( Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] . 'tmpdir/file.xml' )){
		$str = file_get_contents('http://expert-realty.com.ua/export/myrents/myrents.xml');
		file_put_contents(Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] . 'tmpdir/file.xml' , $str);
	    }
	    $xml = simplexml_load_file(Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] . 'tmpdir/file.xml');
	    $count = count($xml->realty);
	    $end = $form->start + $step;
	    if ($end > $count - 1) {
		$end = $count - 1;
		$completed = true;
	    }
	    $this->execute((int) $form->start, $end, $xml);
	    $form->start = $end;
	}
	if (isset($_POST['isajax']))
	    $this->renderPartial('_form', array('count' => $count, 'formModel' => $form, 'completed' => $completed, 'reload' => true));
	else
	    $this->assignAndRender($view, array('count' => $count, 'formModel' => $form, 'completed' => $completed, 'reload' => false));
    }

    public function execute($start, $end, $xml) {

	for ($i = $start; $i < $end; $i++) {
	    $realty = $xml->realty[$i];
	    $rent = new Rent();
	    $rent->user = $realty->user_id;
	    //$rent->user = 67;
	    $rent->todo = 2;
	    $rent->type = $realty->realty_type;
	    $rent->price_day = $realty->price * 8;
	    $rent->floor = ($realty->floor<=15)?$realty->floor:15;
	    $rent->rooms_count = $realty->rooms_count;
	    $rent->square = $realty->total_area;
	    $rent->creation_date = date("Y-m-d H:i:s", strtotime($realty->DateFrom));

	    //  if ($rent->validate()) {
	    if ($rent->save()) {
		//$rent->id = 500; 
		$description = new RentDescription();
		$description->language = 1;
		$description->rent = $rent->id;
		$description->name = $this->unTag((string) $realty->adtitle);
		$description->overview = $this->unTag((string) $realty->description);
		$description->save();   //
		$nbIDs = array(
		    'magazin' => 3,
		    'supermarket' => 4,
		    'stadium' => 5,
		    'school' => 6,
		    'rinok' => 7,
		    'zd_vokzal' => 8,
		    'avto_vokzal' => 9,
		    'teatr' => 10,
		    'kino' => 11,
		    'ipodrom' => 12,
		    'kafe' => 15,
		    'metro' => 16,
		    'fitnes' => 17,
		    'sadik' => 18,
		);
		$newNeighborsList = $arrayToBM = array();
		foreach ($realty->vicinity as $vicinity) {
		    foreach ($vicinity as $key => $onevicinity) {
			if ((int) $onevicinity) {
			    $newNeighborsList[] = array('id' => $nbIDs[$key]);
			    $arrayToBM[] = $nbIDs[$key];
			}
		    }
		}

		$adress = new Adress();
		$adress->rent_id = $rent->id;
		$adress->name = ((string) $realty->country)
			. ', ' . ((string) $realty->state)
			. ', ' . ((string) $realty->city)
			. ', ' . ((string) $realty->rayon)
			. ', ' . ((string) $realty->street);
		$adress->geox = 30.522301;
		$adress->geoy = 50.451118;
		$adress->save();
		$rent->neiborhood_bitmask = BitMask::ArrToIntBitMask($arrayToBM);
		$rent->setRelationRecords('neighbors', $newNeighborsList);
		$amIDs = array(
		    'parking' => 1,
		    'condition' => 2,
		    'lift' => 3,
		    'internet' => 4,
		    'svc' => 5,
		    'gas_plita' => 6,
		    'telik' => 7,
		    'cabel' => 8,
		    'holodilnik' => 9,
		    'wi-fi' => 12,
		    'basein' => 13
		);
		$newAmenityList = $arrayToBM = array();
		foreach ($realty->comfort as $comfort) {
		    foreach ($comfort as $key => $onecomfort) {
			if ((int) $onecomfort) {
			    $newAmenityList[] = array('id' => $amIDs[$key]);
			    $arrayToBM[] = $amIDs[$key];
			}
		    }
		}
		$rent->amenity_bitmask = BitMask::ArrToIntBitMask($arrayToBM);
		$rent->setRelationRecords('amenities', $newAmenityList);
		foreach ($realty->photos_urls as $photosUrl) {
		    foreach ($photosUrl as $key => $photoUrl) {
			$downloadedPhoto = new FileFromUrl((string) $photoUrl);
			$filename = CustomFunctions::translit($downloadedPhoto->getName());
			$filename = ImageProcessing::image()
				->saveImage($downloadedPhoto, $filename, array(
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
		$rent->save();
	    }
	}
    }
    
    /**
     * убирание предварительного форматирования
     * @param type $str
     * @return type 
     */
 private function unTag($str){
     $result = str_replace(
             array("&quot;","&lt;br&gt;","<br>"),
             array('\"',    "\n",        "\n"),
             $str);
     return $result;
 }
}
?>