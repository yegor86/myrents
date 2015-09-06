<?php

/**
 * This is the model class for table "Adress".
 *
 * The followings are the available columns in table 'Adress':
 * @property integer $id
 * @property string $name
 * @property double $geox
 * @property double $geoy
 * @property integer $rent_id
 *
 * The followings are the available model relations:
 * @property Rent $rent
 */
class Adress extends MRActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return Adress the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'Adress';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('name, rent_id', 'required',
		'message'=>Yii::t('default','message.Adress.name.is.required')),
	    array('geox, geoy', 'required',
		'message'=>Yii::t('default','message.Adress.geopoint.is.required')),
	    array('rent_id', 'numerical', 'integerOnly' => true),
	    array('geox, geoy', 'numerical',
		'message'=>Yii::t('default','message.Adress.geopoint.must.be.munerical')),
	    array('name, name_en', 'length', 'max' => 250,
		'message'=>Yii::t('default','message.Adress.name.max.length')),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, name, name_en, geox, geoy, rent_id', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'rent' => array(self::BELONGS_TO, 'Rent', 'rent_id'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => 'ID',
	    'name' => 'Name',
	    'geox' => 'Geox',
	    'geoy' => 'Geoy',
	    'rent_id' => 'Rent',
	);
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
	// Warning: Please modify the following code to remove attributes that
	// should not be searched.

	$criteria = new CDbCriteria;

	$criteria->compare('id', $this->id);
	$criteria->compare('name', $this->name, true);
	$criteria->compare('name_en', $this->name_en, true);
	$criteria->compare('geox', $this->geox);
	$criteria->compare('geoy', $this->geoy);
	$criteria->compare('rent_id', $this->rent_id);

	return new CActiveDataProvider($this, array(
		    'criteria' => $criteria,
		));
    }

}