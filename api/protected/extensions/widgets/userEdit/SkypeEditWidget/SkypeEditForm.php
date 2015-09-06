<?php

//модель формы ввода и редактирования описания
class SkypeEditForm extends CFormModel {

    public $skype;

    public function rules() {
	return array(
	    array('skype', 'length', 'max' => 30, 'message'=>Yii::t('default','message.wgt.skypeEdit.form.errorlength')),
            array('skype','match', 'pattern'=>'/^[-a-z\d_\/]*$/i', 'message'=>Yii::t('default','message.wgt.skypeEdit.form.errorRuCharset')),
	);
    }

    public function attributeLabels() {
	return array(
	    'skype' => 'Скайп',
	);
    }

}

?>
