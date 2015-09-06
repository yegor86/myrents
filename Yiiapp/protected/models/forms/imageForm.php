<?php

/**
 * fileForm class.
 * fileForm is the data structure for keeping
 */
class imageForm extends CFormModel {

    public $file;
    
    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            // username and password are required
            array('file','file', 'types'=>'gif, jpg, jpeg, png','allowEmpty'=>false),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'file' =>Yii::t('default','AR.imageForm.select.file'),
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
