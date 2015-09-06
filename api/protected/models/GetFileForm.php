<?php
/**
 *Форма для пошагового выполнения крупных запросов (к примеру импорт-экспорт большого объёма объявлений) 
 */


class GetFileForm extends CFormModel {
public $file;
public $url;
    
    public function rules() {
	return array(
	    array('file', 'file', 'types'=>'xml, jpg', 'maxFiles'=>1,'allowEmpty'=>true),
	    array('url', 'url','allowEmpty'=>true),
	);
    }
    public function attributeLabels() {
	return array(
	    'file' => Yii::t('api','AR.GetFileForm.file'),
	    'url' => Yii::t('api','AR.GetFileForm.url')
	);
    }

}

