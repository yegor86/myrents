<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class AdminAddRoleUserForm extends CFormModel {

    public $role;
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
	return array(
	    // username and password are required
	    array('role', 'required'),

	);
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
	return array(
	    'role' => 'Вывести на главную',
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
