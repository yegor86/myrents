<?php

class RegisterForm extends CFormModel {

    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $confirmpassword;

    public function tableName() {
	return 'User';
    }

    public function rules() {


	return array(
	    array('firstname, lastname, email, password, confirmpassword', 'required', 
		'message' => Yii::t('default', 'message.RegisterForm.input.required.values')),
	    array('firstname, lastname', 'length', 'min' => 3, 'max' => 20,
		'message' => Yii::t('default', 'message.RegisterForm.minval.3.and.maxval.20')),
	    array('password', 'length', 'min' => 6, 'max' => 20,  
		'message' => Yii::t('default', 'message.RegisterForm.minval.3.and.maxval.20')),
	    array('email', 'match', 'pattern' => '/^[\da-z][-_\d\.a-z]*@(?:[\da-z][-_\da-z]*\.)+[a-z]{2,5}$/iu',
		'message' => Yii::t('default', 'message.RegisterForm.not.valid.email.entered')),
	    array('email', 'filter', 'filter' => 'mb_strtolower', 'enableClientValidation' => true),
	    array('firstname, lastname', 'match', 'pattern' => '/^[-a-zа-я\s]+$/iu',
		'message' => Yii::t('default', 'message.RegisterForm.must.contain.only.letters')),
	    array('confirmpassword', 'compare', 'compareAttribute' => 'password',
		'message' => Yii::t('default', 'message.RegisterForm.passwd.and.confirm.not.compare')),
	);
    }

    public function attributeLabels() {
	return array(
	    'firstname' => Yii::t('default','AR.RegisterForm.firstname'),
	    'lastname' => Yii::t('default','AR.RegisterForm.lastname'),
	    'email' => Yii::t('default','AR.RegisterForm.email'),
	    'password' => Yii::t('default','AR.RegisterForm.password'),
	    'confirmpassword' => Yii::t('default','AR.RegisterForm.confirmpassword'),
	);
    }

}