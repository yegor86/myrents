<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    protected $_id;
    protected $_nick;

    public function authenticatenopass($usermodel) {

	$this->_id = $usermodel->id;
	$this->_nick = $usermodel->nick;
	$this->setState('nick', $usermodel->nick);
	$this->setState('title', $usermodel->nick);
	$this->errorCode = self::ERROR_NONE;
	return !$this->errorCode;
    }

    public function authenticate() {
	$record = User::model()->findByAttributes(array('nick' => $this->name));
	if ($record === null)
	    $this->errorCode = self::ERROR_USERNAME_INVALID;
	else if ($record->password !== md5($this->password))
	    $this->errorCode = self::ERROR_PASSWORD_INVALID;
	else {
	    $this->_id = $record->id;
	    $this->_nick = $record->nick;
	    $this->setState('nick', $record->nick);
	    $this->setState('roles', $record->role);
	    $this->setState('title', $record->nick);
	    $this->errorCode = self::ERROR_NONE;
	}
	return !$this->errorCode;
    }

    public function getId() {
	return $this->_id;
    }

    public function getNick() {
	return $this->_nick;
    }

}