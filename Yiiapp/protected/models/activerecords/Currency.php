<?php

/**
 * This is the model class for table "Currency".
 *
 * The followings are the available columns in table 'Currency':
 * @property integer $id
 * @property string $full_name
 * @property string $short_name
 * @property string $symbol
 * @property double $rate
 */
class Currency extends MRActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return Currency the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'Currency';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('full_name, short_name', 'required'),
	    array('rate', 'numerical'),
	    array('full_name', 'length', 'max' => 50),
	    array('short_name', 'length', 'max' => 4),
	    array('symbol', 'length', 'max' => 1),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, full_name, short_name, symbol, rate', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => 'ID',
	    'full_name' => 'Full Name',
	    'short_name' => 'Short Name',
	    'symbol' => 'Symbol',
	    'rate' => 'Rate',
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
	$criteria->compare('full_name', $this->full_name, true);
	$criteria->compare('short_name', $this->short_name, true);
	$criteria->compare('symbol', $this->symbol, true);
	$criteria->compare('rate', $this->rate);

	return new CActiveDataProvider($this, array(
		    'criteria' => $criteria,
		));
    }

}