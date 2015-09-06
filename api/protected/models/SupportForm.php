<?php

/**
 * AdressForm class.
 */
class SupportForm extends CFormModel {

    public $name;
    public $email;
    public $description;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
	return array(
	    // username and password are required
	    array('name', 'required',
		'message' => Yii::t('default','message.SupportForm.name.is.required')),
	    array('email', 'required',
		'message' => Yii::t('default','message.SupportForm.email.is.required')),
	    array('description', 'required',
		'message' => Yii::t('default','message.SupportForm.description.is.required')),
	    array('email', 'match', 'pattern' => '/^[\da-z][-_\d\.a-z]*@(?:[\da-z][-_\da-z]*\.)+[a-z]{2,5}$/iu',
		'message' => Yii::t('default', 'message.SupportForm.not.valid.email.entered')),
	);
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
	return array(
	    'name' => Yii::t('default','AR.SupportForm.name'),
	    'email' => Yii::t('default','AR.SupportForm.email'),
	    'description' => Yii::t('default','AR.SupportForm.description'),
	);
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
}
