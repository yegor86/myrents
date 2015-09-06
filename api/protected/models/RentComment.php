<?php

/**
 * This is the model class for table "RentComment".
 *
 * The followings are the available columns in table 'RentComment':
 * @property integer $id
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $date
 * @property string $message
 * @property integer $in_show
 *
 * The followings are the available model relations:
 * @property Rent $receiver
 * @property User $sender
 */
class RentComment extends CActiveRecord
{
    public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RentComment the static model class
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
		return 'RentComment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sender_id, receiver_id, date, message', 'required', 
			    'message'=>Yii::t('default','message.RentComment.required')),
			array('sender_id, receiver_id, in_show', 'numerical', 'integerOnly'=>true),
		                  array('message', 'length', 'max'=>1000,
			     'message'=>Yii::t('default','message.RentComment.length.max.1000')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sender_id, receiver_id, date, message, in_show', 'safe', 'on'=>'search'),
		    array('verifyCode', 'required', 'on'=>'insert',
                     'message'=>Yii::t('default','message.verifyCode.required')),
		    array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),

			
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
			'receiver' => array(self::BELONGS_TO, 'Rent', 'receiver_id'),
			'sender' => array(self::BELONGS_TO, 'User', 'sender_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sender_id' => 'Sender',
			'receiver_id' => 'Receiver',
			'date' => 'Date',
			'message' => 'Message',
			'in_show' => 'In Show',
			'verifyCode' => Yii::t('default','AR.RentComment.capcha')
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

		$criteria->compare('id',$this->id);
		$criteria->compare('sender_id',$this->sender_id);
		$criteria->compare('receiver_id',$this->receiver_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('in_show',$this->in_show);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}