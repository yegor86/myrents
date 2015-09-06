<?php

//модель формы ввода и редактирования телефона, имеет всего одно поле - телефон
class PhonesForm extends CFormModel {

    public $phone;

    public function rules() {
	return array(
	    //array('phone', 'required'),
	    array('phone','match', 'pattern'=>'/^(?:\+[\d]{1,2})?\s*(?:\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/',
		'message'=>Yii::t('default','message.wgt.PhonesForm.phone.match')),
	    
	);
    }

    public function attributeLabels() {
	return array(
	    'phone' => 'Номер',
	);
    }

}

?>
