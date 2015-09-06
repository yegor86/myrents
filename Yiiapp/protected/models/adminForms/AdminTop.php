<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class AdminTop extends CFormModel {

    public $rent_id;
    public $days;
    public $to;
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
	return array(
	    // username and password are required
	    array('rent_id, days, to', 'required'),
	    array('rent_id, days', 'numerical', 'integerOnly'=>true, 'min'=>0),
            array('to','in','range'=>Yii::app()->params['billingActions']),
	);
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
	return array(
	    'rent_id' => 'ID объявления',
            'days' => 'Количество дней',
            'to' => 'Куда'
	);
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
}
