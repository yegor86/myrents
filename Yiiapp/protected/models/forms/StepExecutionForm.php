<?php
/**
 *Форма для пошагового выполнения крупных запросов (к примеру импорт-экспорт большого объёма объявлений) 
 */

class StepExecutionForm extends CFormModel {
    public $start = 0;
    public function rules() {
	return array(
	    array('start', 'required'),
	    array('start', 'numerical', 'integerOnly' => true),
	);
    }
    public function attributeLabels() {
	return array(
	    'start' => 'Start',
	);
    }

}

