<?php

/**
 * This is the model class for table "Top".
 *
 * The followings are the available columns in table 'Top':
 * @property integer $rent_id
 * @property string $start
 * @property string $end
 * @property string $action
 *
 * The followings are the available model relations:
 * @property Rent $rent
 */
class Top extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Top the static model class
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
		return 'Top';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rent_id, start, action', 'required'),
			array('rent_id', 'numerical', 'integerOnly'=>true),
			array('action', 'length', 'max'=>3),
			array('end', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rent_id, start, end, action', 'safe', 'on'=>'search'),
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
			'billingAction' => array(self::BELONGS_TO, 'BillingAction', 'action'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rent_id' => 'Rent',
			'start' => 'Start',
			'end' => 'End',
			'action' => 'Action',
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

		$criteria->compare('rent_id',$this->rent_id);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('action',$this->action,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}