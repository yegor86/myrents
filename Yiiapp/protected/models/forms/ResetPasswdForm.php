<?php

class ResetPasswdForm extends CFormModel {

    public $passwd;
    public $confirm;


    public function rules() {
	return array(
	    array('passwd', 'required', 
		'message' => Yii::t('default', 'message.ResetPasswdForm.passwd.required.values')),
	    array('confirm', 'required', 
		'message' => Yii::t('default', 'message.ResetPasswdForm.confirm.required.values')),
	    array('passwd', 'length', 'min' => 6, 'max' => 20,  
		'message' => Yii::t('default', 'message.ResetPasswdForm.passwd.6.and.maxval.20')),
	    array('confirm', 'compare', 'compareAttribute' => 'passwd',
		'message' => Yii::t('default', 'message.ResetPasswdForm.passwd.and.confirm.not.compare')),
	);
    }

    public function attributeLabels() {
	return array(
	    'passwd' => Yii::t('default','AR.ResetPasswdForm.passwd'),
	    'confirm' => Yii::t('default','AR.ResetPasswdForm.confirm'),
	);
    }

}

