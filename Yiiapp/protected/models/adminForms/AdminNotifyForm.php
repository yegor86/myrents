<?php
/**
 * форма отправки штучного уведомления
 *
 * The followings are the available columns in table 'RentComment':
 * @property integer $user пользователь, кому отправляется уведомление
 * @property string $message текст уведомления
 */
class AdminNotifyForm extends CFormModel {

    public $user; 
    public $message;


    public function rules() {
	return array(
	    array('user,message', 'required'),
	    array('message', 'length', 'max'=>1000),
	    array('user', 'numerical', 'integerOnly'=>true, 'min'=>0)
	);
    }

    public function attributeLabels() {
	return array(
	    'message' => 'текст сообщения',
	    'user' => 'Пользватель',
	);
    }

}
