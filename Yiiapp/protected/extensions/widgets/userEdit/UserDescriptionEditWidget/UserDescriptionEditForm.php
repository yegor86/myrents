<?php

//модель формы ввода и редактирования описания
class UserDescriptionEditForm extends CFormModel {

    public $overview;

    public function rules() {
	return array(
	    array('overview', 'length', 'max' => Yii::app()->params['maxlength']['UserOverview'],
		'message'=>Yii::t('default','message.wgt.UserDescriptionEditForm.overview.maxlength',array('{N}'=>Yii::app()->params['maxlength']['UserOverview'])))
	);
    }

    public function attributeLabels() {
	return array(
	    'overview' => 'Описание',
	);
    }

}

?>
