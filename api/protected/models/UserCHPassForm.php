<?php

/**
 * UserCHPassForm class.
 */
class UserCHPassForm extends CFormModel {

    public $oldpass;
    public $passwd;
    public $confirm;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
	return array(
	    // username and password are required
	    array('oldpass, passwd, confirm', 'required', 'enableClientValidation' => true, 
		'message' => Yii::t('default','message.UserCHPassForm.required.values')),
	    array('confirm','compare','compareAttribute'=>'passwd',
		'message' => Yii::t('default','message.UserCHPassForm.confirm.not.compare')),
	    array('oldpass, confirm','type', 'type' => 'string'),
	    array('passwd', 'length', 'min' => 6, 'max' => 20, 
		'message' => Yii::t('default','message.UserCHPassForm.passwd.min6.max20')),
	);
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
	return array(
	    'oldpass' => Yii::t('default','AR.UserCHPassForm.oldpass'),
	    'passwd' => Yii::t('default','AR.UserCHPassForm.passwd'),
	    'confirm' => Yii::t('default','AR.UserCHPassForm.confirm'),
	);
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
}
