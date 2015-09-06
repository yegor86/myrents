<?php

/**
 * This is the model class for table "TempSMS".
 *
 * The followings are the available columns in table 'TempSMS':
 * @property integer $sms_id
 * @property integer $rent_id
 * @property string $date
 * @property string $action
 * @property string $number
 * The followings are the available model relations:
 * @property Rent $rent
 */
class TempSMS extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TempSMS the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TempSMS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sms_id, rent_id', 'required'),
			array('sms_id, rent_id', 'numerical', 'integerOnly'=>true),
			array('action, number', 'type', 'type'=>'string'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sms_id, rent_id, date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'rent' => array(self::BELONGS_TO, 'Rent', 'rent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sms_id' => 'Sms',
			'rent_id' => 'Rent',
			'date' => 'Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('sms_id',$this->sms_id);
		$criteria->compare('rent_id',$this->rent_id);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}