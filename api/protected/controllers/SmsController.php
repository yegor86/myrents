<?php
/*
 * обработчик смс-биллинга
 */
Yii::import('application.controllers.MyRentsController');
class SmsController extends MyRentsController {
    
    public function actionError() {
	echo('ERROR');
    }
    
    //экшн, вызываемый от сервера смс-биллинга
    public function actionIncoming(){
	//формируем ответ обработчиком 
        $response ='';
	Yii::log("received query from SMS service", 'info','SMS');
	Yii::log(CustomFunctions::ArrayToText($_POST), 'info','SMS');
	if (isset($_POST['secret_key'])) {
	    $response = $this->firstSMS($_POST);
	} else {
	    $response = $this->lastSMS($_POST);
	}
	echo $response;
    }

     /**
      * обработа 
      * @param TempSMS $tempSMS
      * @return boolean 
     */
    public function operate($tempSMS){
	$result = false;
	if(isset(Yii::app()->params['smsTopPeriods'][$tempSMS->number])){
	    $rent = Rent::model()->with('renter')->findByPk($tempSMS->rent_id);
	    if($rent){
		TopFunc::init()->addToTop($rent->id,
			Yii::app()->params['smsTopPeriods'][$tempSMS->number]['periodInDays'],
			$tempSMS->action);
		$result = true;
		$opLog = new OperationLog();
		$opLog->operation_id = 5;
		$opLog->user_id = $rent->renter->id;
		$opLog->comment = 'add rent '. $rent->id .' to '.$tempSMS->action .' for'. Yii::app()->params['smsTopPeriods'][$tempSMS->number]['periodInDays']. 'days (number'.$tempSMS->number .')';
		$opLog->save();
		$rent->renter->notify(Yii::t('default','rent.was.topped',array(':rentId'=>$rent->id)));
	    }
	}
	return $result;
    }
    
    
        /**
     *  валидатор СМС-запроса
     * @param type $vars 
     * @return boolean
     */
    private function checkSMSRequest($vars){
	$result = true;
	if(!isset($vars['secret_word'])||$vars['secret_word']!=md5(Yii::app()->params['smsbill_secret'])
		 ||!isset($vars['secret_key'])
		 ||!isset($vars['sms_id'])
		 ||!isset($vars['sms_body'])
		 ||!isset($vars['site_service_id'])
		 ||!isset($vars['operator_id'])
		 ||!isset($vars['num'])
		 ||!isset($vars['sms_price'])
	||($vars['secret_key']!=md5($vars['sms_id'] . $vars['sms_body'] . $vars['site_service_id'] . $vars['operator_id'] . $vars['num'] . $vars['sms_price'] . Yii::app()->params['smsbill_secret'])))  $result = false;
	return $result;
    }
    
        /**
     * обработка стартового запроса
     * @param mixed $vars
     * @return string 
     */
    public function firstSMS($vars) {
	$result = '';
	//если запрос валидный
	if ($this->checkSMSRequest($vars)) {
	    $error = '0';
	    $operands = array();
	    //изымаем из текста смс нужный кусок информации
	    $regexpPart = implode('|', Yii::app()->params['billingActions']);
	    $regexp = '/^'.Yii::app()->params['smsbillmainprefix'].Yii::app()->params['smsbillMRprefix'].'\+(\d+)('.$regexpPart.')$/ui';
	    if (!preg_match($regexp, $vars['sms_body'], $operands)) {
		$response = Yii::t('default', 'sms.wrong.message');
		$error = '1';
		Yii::log($vars['sms_id']." has errors", 'info','SMS');
	    } elseif (!in_array($operands[2], Yii::app()->params['billingActions'])) {
		$response = Yii::t('default', 'sms.wrong.action');
		$error = '1';
		Yii::log($vars['sms_id']." has errors", 'info','SMS');
	    } else{
		$rent = Rent::model()->findByPk($operands[1]);
		if(!$rent){
		    $response = Yii::t('default', 'sms.rent.not.found',array(':rent'=>$operands[1]));
		    $error = '1';
		    Yii::log($vars['sms_id']." has errors", 'info','SMS');
		}elseif(($operands[2]=='t'&&!$rent->isCompleted())||($operands[2]=='m'&&!$rent->isCompleted(true))){
		    $response = Yii::t('default', 'sms.rent.not.valid',array(':rent'=>$operands[1]));
		    $error = '1';
		    Yii::log($vars['sms_id']." has errors", 'info','SMS');
		}else{
		    /*если всё пучком - сохраняем временное сообщение и выдаёт ответ*/
		    $tempsms = new TempSMS();
		    $tempsms->sms_id = $vars['sms_id'];
		    $tempsms->rent_id = $operands[1];
		    $tempsms->number = $vars['num'];
		    $tempsms->action = $operands[2];
		    if(!$tempsms->save()){
			$response = Yii::t('default', 'sms.processing.error',array(':sms'=>$tempsms->sms_id));	
			Yii::log($vars['sms_id']."  error saving TempSMS", 'info','SMS');
			$error = '1';
		    }else{
		    $response = Yii::t('default', 'sms.rent.added.'.$operands[2],array(':rent'=>$operands[1]));
		    $error = '0';
		    Yii::log($vars['sms_id']." was added", 'info','SMS');
		    }
		}
	    }
	    $result = 'sms_id:' . $vars['sms_id'] . "\n";
	    $result .= 'response:' . $response . "\n";
	    $result .= 'error:' . $error . "\n";
	}
	//иначе ответ об ошибке
	else {
	    $result = 'ERROR';
	}
	return $result;
    }
    
    /**
     * обработка завершающего запроса
     * @param type $vars 
     * @return string
     */
    public function lastSMS($vars) {
	$result = '';
	$tempSMS = TempSMS::model()->findByPk($vars['sms_id']);
	if (!$tempSMS) {
	    $result = 'ERROR, sms ' . $vars['sms_id'] . ' was not founded';
	    Yii::log("message ".  $vars['sms_id']. " does not exist" , 'info', 'SMS');
	} else {

	    if ($vars['status']) {
		Yii::log($tempSMS->sms_id . " was paid, processing...", 'info', 'SMS');
		if ($this->operate($tempSMS)) {
		    Yii::log($tempSMS->sms_id . " was processed", 'info', 'SMS');
		    $result = 'OK';
		} else {
		    Yii::log($tempSMS->sms_id . " processing error", 'info', 'SMS');
		    $result = 'ERROR';
		}
	    } else {
		Yii::log($tempSMS->sms_id . " was not paid, decline.", 'info', 'SMS');
		$result = 'DECLINE';
	    }
	    $tempSMS->delete();
	}
	return $result;
    }
    
}