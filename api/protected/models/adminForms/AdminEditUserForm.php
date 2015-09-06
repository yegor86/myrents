<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class AdminEditUserForm extends CFormModel {

    public $firstname;
    public $lastname;
    public $role;
    public $overview;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
	return array(
	    // username and password are required
	    array('firstname, lastname, role', 'required'),
            array('id, firstname, lastname, role, overview', 'safe', 'on'=>'search'),
            array('overview', 'type','type'=>'string'),
	);
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
	return array(
	    'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'role' => 'Роль',
            'overview' => 'Описание о себе',
	);
    }

}
