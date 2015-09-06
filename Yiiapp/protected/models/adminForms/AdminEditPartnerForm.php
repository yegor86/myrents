<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class AdminEditUserForm extends CFormModel {

    public $id;
    public $firstname;
    public $lastname;
    public $overview;
    public $role;
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
	return array(
	    // username and password are required
	    array('firstname, lastname, role', 'required'),
	);
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
	return array(
	    'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'overview' => 'Описание себя ;)',
            'Роль' => 'Статус',
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
