<?php
Yii::import('application.controllers.RentEditMainController');
class RentEditNeiborhoodController extends RentEditMainController {

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
	$rent = Rent::model()->with(array('neighbors', 'renter' => array('select' => 'id')))->findByPk($id);
	if ($rent) {

		$neighborsList = Neighbor::model()->cache(Yii::app()->params['cachetime'])->findAll();
		if (isset($_POST['Neighbor'])) {
		    $this->applyParamsAndSave($rent, $neighborsList);
		}
		$neighbordArray = $this->modelsToArray($rent->neighbors);
		$this->assignAndRender('edit', array('rent' => $rent, 'neighbors' => $neighborsList, 'rentneibordsarr' => $neighbordArray));
	} else
	    throw new CHttpException(404, 'page not found');
    }

    /**
     * применение параметров, валидация и сохранение
     * @param Rent $rent
     * @param Amenitie[] $amenitieslist 
     */
    private function applyParamsAndSave($rent, $neighborsList) {
	$newNeighborsList = array();
	$arrayToBM = array();
	foreach ($neighborsList as $key => $neighbor) {
	    if (isset($_POST['Neighbor'][$key]['id']) && ($_POST['Neighbor'][$key]['id'])) {
		$newNeighborsList[] = array('id' => $neighbor->id);
		$arrayToBM[] = $neighbor->id;
	    }
	}
	$rent->neiborhood_bitmask = BitMask::ArrToIntBitMask($arrayToBM);
	$rent->setRelationRecords('neighbors', $newNeighborsList);
	if ($rent->validate()) {
	    $rent->save();
	    Yii::app()->user->setFlash('success', Yii::t('default', 'flash.bill.saved'));   //добавляем сообщение об успешном сохранении
	    if (isset($_POST['newdoc']) && ($_POST['newdoc']))
		$this->redirect($_POST['newdoc']);	//если есть переход на другую страницу - переходим
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
	    'charCount.js',
		    'jquery.fancybox.js',
            //'upScript.js' //скрипт для апов
		)
	);
	$this->render($view, $params);
    }

}

?>
