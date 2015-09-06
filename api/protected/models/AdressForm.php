<?php

/**
 * AdressForm class.
 */
class AdressForm extends CFormModel {

    public $adress_name;
    public $geopoint;
    public $adress_prefix;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
	return array(
	    // username and password are required
	    array('adress_name', 'required',
		'message' => Yii::t('default','message.Adress.name.is.required')),
	    array('geopoint', 'required',
		'message' => Yii::t('default','message.Adress.geopoint.is.required')),
	    array('geopoint', 'match', 'pattern' => '/^\s*\d{1,2}(?:\.\d+)?\s*,\s*\d{1,2}(?:\.\d+)?\s*$/i', 
		'message'=>Yii::t('default','message.Adress.geopoint.must.be.munerical')),
	    array('adress_name, adress_prefix', 'type', 'type' => 'string')
	);
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
	return array(
	    'adress_name' => Yii::t('default','AR.AdressForm.address'),
	);
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
}
