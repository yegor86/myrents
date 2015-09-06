<?php

//класс отправки уведомлений
class Notificator {

    static private $_singletone = false; //синглтон-объект

    /**
     *для реализации синглтона закрыта в приват 
     */
    private function __construct() {
	
    }

    /**
     * синглтон-функция, возвращает статичный экземпляр класса
     * @return Notificator
     */
    static public function ST() {
	if (self::$_singletone == false) {
	    self::$_singletone = new Notificator();
	}
	return self::$_singletone;
    }

    /**
     *отправка сообщения, используя модель пользователя
     * @param User $user
     * @param string $message
     * @return boolean 
     */
    public function sendNotification($user, $message) {
	$result = false; //результат выполнения по умолчанию false
	switch ($user->service) {
	    case 'local': if($user->subscribed) $result = $this->MailNotify($user->nick, $message);
		break;
	    case 'vkontakte':$result = $this->VKNotify(str_replace('vkontakte', '', $user->nick), $message);
		break;
	    case 'facebook':$result = $this->FBNotify(str_replace('facebook', '', $user->nick), $message);
		break;
	    default : $result=false;
	}
	return $result;;
    }

    /**
     * уведомление ВК
     * @param integer $id
     * @param string $message
     * @return boolean 
     */
    public function VKNotify($id, $message) {
	    $client_id = Yii::app()->eauth->services['vkontakte']['client_id'];
	    $client_secret = Yii::app()->eauth->services['vkontakte']['client_secret'];
	    $vk = new vkapi($client_id, $client_secret);
	    $answer = $vk->api('secure.sendNotification', array('uids'=>$id,'message'=>$message));
	return true;
    }

    /**
     * уведомление фейсбук
     * @param integer $id
     * @param string $message
     * @return boolean 
     */
    public function FBNotify($id, $message) {
	return true; //TODO: добавить функционал уведомления фейсбука
    }

    /**
     * уведомление по почте
     * @param string $mail
     * @param string $message
     * @return boolean 
     */
    public function MailNotify($mail, $message, $headersArray = array()) {
	//if(!$baseURL) $baseURL = Yii::app()->request->hostInfo . Yii::app()->request->baseUrl ;
	if(!count($headersArray)){
	$headers = "From: {".Yii::app()->params['noreplyEmail']."}\r\n";
	}else{
	    $headers = implode("\r\n", $headersArray);
	}
	mail($mail, 'MyRents notification, no-reply', $message, $headers);
	return true;
    }

}