<?php

class RemindPassForm extends CFormModel {

    public $email;


    public function rules() {
	return array(
	    array('email', 'required', 
		'message' => Yii::t('default', 'message.RemindPassForm.email.required.values')),
	    array('email', 'match', 'pattern' => '/^[\da-z][-_\d\.a-z]*@(?:[\da-z][-_\da-z]*\.)+[a-z]{2,5}$/iu',
		'message' => Yii::t('default', 'message.RegisterForm.not.valid.email.entered')),
	);
    }

    public function attributeLabels() {
	return array(
	    'email' => Yii::t('default','AR.RemindPassForm.email'),
	);
    }

}

