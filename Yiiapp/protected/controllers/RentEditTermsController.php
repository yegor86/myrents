<?php
Yii::import('application.controllers.RentEditMainController');
class RentEditTermsController extends RentEditMainController {
/**
 * редактирование цен
 * @param type $id
 * @throws CHttpException 
 */
    public function actionEdit($id = 0) {
	$rent = Rent::model()->with(array('renter' => array('select' => 'id')))->findByPk($id);
	$prices_types = array();
	$Currency = $this->currencies;
	foreach (Yii::app()->params['current_price'] as $key=>$price)
	$prices_types[$key] =Yii::t('default',$price['row']);
	if ($rent) {
		if (isset($_POST['Rent'])) {
		    $this->applyParamsAndSave($rent);
		}
		$view = ($rent->todo == 1) ? 'edit_three_prices' : 'edit_one_price';
		$this->assignAndRender($view, array('rent' => $rent, 'prices_types' => $prices_types, 'currency'=>$Currency));
	} else
	    throw new CHttpException(404, 'page not found');
    }

    /**
     * применение параметров, валидация и сохранение
     * @param Rent $rent 
     */
    private function applyParamsAndSave($rent) {
	$rent->price_week = $rent->price_day = $rent->price_month = 0;
	$rent->current_price = 1;
	$rent->attributes = $_POST['Rent'];
	$rent->current_price = ($rent->todo == 1) ? (isset($_POST['Rent']['current_price'])&&$_POST['Rent']['current_price']) ? $_POST['Rent']['current_price'] : 1 : 1;
	//if($rent->todo!=1)$rent->current_price = 1;
	$currenciesById = array();
	foreach($this->currencies as $currency){
	    $currenciesById[$currency->id] = $currency;
	}
	
	$currency_rate = Currency::model()->findByPk($_POST['Rent']['currency_id'])->rate;
	$rent->price_day = (float)str_replace(",", ".", $rent->price_day);
	$rent->price_week = (float)str_replace(",", ".", $rent->price_week);
	$rent->price_month = (float)str_replace(",", ".", $rent->price_month);
	//сразу-же создаём индексные цены
	$rent->index_price_day = $rent->price_day * $currency_rate;
	$rent->index_price_week = $rent->price_week * $currency_rate;
	$rent->index_price_month = $rent->price_month * $currency_rate;
	
	if ($rent->validate()) {
	    $rent->save();
	    Yii::app()->user->setFlash('success', Yii::t('default', 'flash.bill.saved'));   //добавляем сообщение об успешном сохранении
	    if (isset($_POST['newdoc']) && ($_POST['newdoc']))
		$this->redirect($_POST['newdoc']); //если есть переход на другую страницу - переходим
	}else
	    Yii::app()->user->setFlash('error', Yii::t('default', 'flash.bill.not.saved'));   //добавляем сообщение об неуспешном сохранении

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
//'upScript.js', //скрипт для апов
		    'jquery.fancybox.js',
		)
	);
	$this->render($view, $params);
    }

}

?>
