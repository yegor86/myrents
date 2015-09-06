<?php

/**
 * класс приёма-отправки сообщений, наследуется от класса пользователя
 */
Yii::import('application.controllers.UserController');

class MessagesController extends UserController {
    public function filters() {
	return array(
	    'accessControl'
	);
    }
        public function accessRules() {
	return array(
	    array('allow', // deny all users
		'users' => array('@'),
		'actions'=>array('send'),
		'roles' => array('writter','moderator','admin'),
		'message' => 'Access Denied.',
	    ),
	    array('allow',
		'users' => array('@'),
		'actions'=>array('messages'),
		'message' => 'Access Denied.',
	    ),
	    array('deny', // deny all users
		'users' => array('*'),
		'message' => 'Access Denied.',
	    ),
	);
    }
    
    
    
    
    /**
     * просмотр сообщений
     * @param type $id
     * @throws CHttpException 
     */
    public function actionMessages($id = 0, $type = 'in') {
	if ($id == $this->user->id) {
	    Message::model()->updateAll(array('readed'=>1),array(
		'condition'=>'direction = \'in\' AND readed = 0 AND receiver_id = :uid',
		'params'=>array(':uid'=>$this->user->id)
	    ));
	    if(isset($_POST['drop'])){
		$this->dropmessage($_POST['drop']);
	    }
	    $view = 'messages';
	    $viewparams['id'] = $id;
	    $viewparams['user'] = $this->user;
	    $viewparams['type'] = $type;
	    $viewparams['remessage'] = false;
	    $criteria = $this->getCriteria($type);
	    $viewparams['messages'] = Message::model()->findAll($criteria);
	    if(isset($_POST['withmenu'])&&$_POST['withmenu'])$view = 'messages_full';
	    $this->show($view,$viewparams);
	}
	else
	    $this->redirect('/user/' . $id);
    }

    /**
     *удаление сообщения по IDшнику, проверяется владелец
     * @param integer $id
     * @return boolean 
     */
    private function dropmessage($id){
	if(!Yii::app()->user->isGuest){
	$message = Message::model()->findByPk($id);
	$uid = Yii::app()->user->id;
	if($message&&(
		($message->receiver_id==$uid&&$message->direction=='in')||
		($message->sender_id==$uid&&$message->direction=='out'))){
	    $message->delete(); return true;
	}
	}return false;
    }
    
    /**
     * получаем условие выборки сообщений для отправленных или полученных
     * @param type $type
     * @return \CDbCriteria 
     */
    private function getCriteria($type='in'){
	    $criteria = new CDbCriteria();
	    $criteria->params = array();
	    $criteria->condition = '`direction` = :direction';
	    $criteria->params[':direction'] = $type;
	    $criteria->params[':userid'] = $this->user->id;
	    $criteria->with = array('sender', 'receiver');
	    if ($type == 'in') {
		$criteria->order = '`readed` ASC, `date` DESC';
		$criteria->condition.=' AND `receiver_id` = :userid';
	    } else {
		$criteria->order = '`date` DESC';
		$criteria->condition.=' AND `sender_id` = :userid';
	    }
	    return $criteria;
    }
    
    
    /**
     * просмотр конкретного сообщения и ответ на него \\зкоментировано поскольку пока-что не нужно
     * @param integer $id
     * @param integer $messid 
     */
    /*
    public function actionRead($id = 0, $messid = 0) {
	if ($id && ($id == $this->user->id)
		&& $message = Message::model()->with('sender', 'receiver')->findByPk($messid, 'receiver_id = \'' . $id . '\'')) {
	    //если открыли сообщение - ставим галочку "прочитано"
	    $view = 'messages';
	    $viewparams = array();
	    $viewparams['user'] = $this->user;
	    $viewparams['type'] = 'read';
	    $viewparams['messages'] = array($message);
	    $viewparams['remessage'] = new Message();
	    if (isset($_POST['Message']) && ($message->receiver_id == Yii::app()->user->id) && ($this->user->active)) {
		$viewparams['remessage']->attributes = $_POST['Message'];
		$viewparams['remessage']->receiver_id = $message->sender_id;
		$viewparams['remessage']->sender_id = Yii::app()->user->id;
		if($this->sendMessage($viewparams['remessage']))
		    $viewparams['remessage']->unsetAttributes(); 
	    }
	    if (Yii::app()->request->isAjaxRequest) {
		$this->renderPartial('_' . $view, $viewparams, false, true);
	    } else
		$this->assignAndRender($view, $viewparams);
	} else
	    $this->redirect('/user/' . $id . '/messages');
    }
*/
    /**
     * отправка сообщения
     * @param integer $id
     * @param integer $receiver_id
     * @throws CHttpException 
     */
    public function actionSend($receiver_id=0){

	$viewparams=array();
	$view = 'cannot_send';
	if(!Yii::app()->user->isGuest&&$this->user->active&&$receiver_id){
	    $view = 'send';
	    $receiver = User::model()->findByPk($receiver_id);
	    if($receiver){
		$message = new Message();
		$message->sender_id = Yii::app()->user->id;
		$message->receiver_id = $receiver_id;
		if(isset($_POST['Message'])){
		    $message->attributes=$_POST['Message'];
		    if($this->sendMessage($message)) //если сообщение отправилось, чистим 
		    $message->unsetAttributes(array('message'));
		}
		$viewparams=array(
		  'user'  =>$this->user,
		    'receiver'=>$receiver,
		    'message'=>$message
		);
	    }else throw new CHttpException(404, 'User not exist');
	}
	$this->show($view, $viewparams);
    }
    
    
    /**
     *  отправка сообщения
     * @param Message $message
     * @return boolean 
     */
     
    private function sendMessage($message) {
	$message->direction = 'out';
	$message->date = date(DATE_W3C);
	if ($message->validate()) {
	    $message->save();  //сохраняем исходящее сообщение
	    $outMessage = new Message('users'); //тут-же создаём входящее сообщение для получателя
	    $outMessage->attributes = $message->attributes;
	    $outMessage->direction = 'in'; //отличаются направлением
	    $outMessage->unsetAttributes(array('verifyCode'));
	 
	    if ($outMessage->save()) {
		$params = array(
		    '{link}' => Yii::app()->request->hostInfo . Yii::app()->request->baseUrl . '/user/' . $outMessage->receiver_id . '/messages/' );
		$outMessage->receiver->staticNotify(User::NOTIFY_RECIVED_MESSAGE, $params);
	    }
	    Yii::app()->user->setFlash('success', Yii::t('messages', 'flash.mesage.sended'));
	    return true;
	} else
	    Yii::app()->user->setFlash('error', Yii::t('messages', 'flash.mesage.not.sended'));
	return false;
    }
    
    
/**
 *Контроллер отписки
 * @param type $mail 
 */
    public function actionUnsubscribe(){
	if(!isset($_GET['email'])||!isset($_GET['secret'])){
		header("HTTP/1.0 404 Not Found");
		throw new CHttpException(404, 'page not found');
	}else{
	    $mail = $_GET['email'];
	    $secert = $_GET['secret'];
	    if($secret != CustomFunctions::createSecret($mail)){
		header("HTTP/1.0 403 Forbidden");
		throw new CHttpException(403, 'invalid link');
	    }else{
	    $usertoUnsubscribe = User::model()->findByAttributes(array('service'=>'local','email'=>$mail));
	    if($usertoUnsubscribe){
		$usertoUnsubscribe->subscribed = 0;
		$usertoUnsubscribe->save();
		$this->assignAndRender('user_was_unsubscribed', array('user'=>$usertoUnsubscribe));
	    }else {
		$this->assignAndRender('user_was_not_found', array('user'=>$usertoUnsubscribe));
	    }
	    }
	}
	
    }
    
    
        public function assignAndRender($view, $params=array()) {
	$this->assignControllerJsCss(
		array(
	    'style.css',
	    'tipTip.css',
	    'slide.css',
	    'jquery-ui-1.8.16.custom.css',
	    'jquery.jscrollpane.css',

                    'jquery.fancybox.css'
		), array(
	    'menu.js',
	    'jquery.tipTip.js',
	    'jquery.jscrollpane.min.js',
	    'jquery.keyboard.js',
	    'jquery-ui-1.8.16.custom.min.js',
	    'jquery.jcarousel.min.js',
	    'jquery.tipTip.js',
	    'somefunctions.js','jquery.fancybox.js',
                    'jquery.mousewheel.js'
		)
	);
	$this->render($view, $params);
    }


}
