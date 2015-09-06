<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class AgencyCreateForm extends CFormModel {

    public $image;
    public $doc;
    public $name;
    public $description;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
	return array(
	 array('name','required'),
	 array('name, description', 'type','type'=>'string'),   
	array('image','file', 'types'=>'gif, jpg, jpeg, png','allowEmpty'=>true),
	array('doc','file','allowEmpty'=>true),    
	);
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
	return array(
            'image' => Yii::t('default','agency.create.image'),
            'doc' => Yii::t('default','agency.create.doc'),
	    'name'=>Yii::t('default','agency.create.name'),
	    'description'=>Yii::t('default','agency.create.description'),
	);
    }

}
