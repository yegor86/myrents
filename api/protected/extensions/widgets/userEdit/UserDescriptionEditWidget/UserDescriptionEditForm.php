<?php

//модель формы ввода и редактирования описания
class UserDescriptionEditForm extends CFormModel {

    public $overview;

    public function rules() {
	return array(
	    array('overview', 'length', 'max' => 600,
		'message'=>Yii::t('default','message.wgt.UserDescriptionEditForm.overview.maxlength.600'))
	);
    }

    public function attributeLabels() {
	return array(
	    'overview' => 'Описание',
	);
    }

}

?>
