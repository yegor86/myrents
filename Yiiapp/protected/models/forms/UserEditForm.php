<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UserEditForm extends CFormModel {

    public $firstname;
    public $lastname;
    public $phone;
    public $image;
    public $rentertype;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
	return array(
	    // username and password are required
	    array('firstname', 'required', 
		'message' =>Yii::t('default','message.UserEditForm.firstname.required')),
	    array('firstname, lastname', 'length', 'min' => 3, 'max' => 20, 
		'message' =>Yii::t('default','message.UserEditForm.firstname.lastname.min3.max20')),
	    array('firstname, lastname', 'match', 'pattern' => '/[-\sa-zа-я]+/i',
		'message' => Yii::t('default','message.UserEditForm.must.contain.only.letters.and.spacing')),
	    array('rentertype', 'match','pattern'=>'/^(user|renter|agency)$/'),
	    array('image', 'file', 'types' => 'gif, jpg,png', 'allowEmpty' => true),
	);
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
	return array(
	    'firstname' => Yii::t('default','AR.UserEditForm.firstname'),
	    'lastname' => Yii::t('default','AR.UserEditForm.lastname'),
	    'rentertype'=>Yii::t('default','AR.UserEditForm.rentertype'),
	);
    }


    public function getTableSchema(){
	return User::model()->tableSchema;
    }
}
