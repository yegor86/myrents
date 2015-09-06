<?php

/**
 * This is the model class for table "Message".
 *
 * The followings are the available columns in table 'Message':
 * @property integer $id
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $direction
 * @property string $date
 * @property string $message
 *
 * The followings are the available model relations:
 * @property User $receiver
 * @property User $sender
 */
class Message extends CActiveRecord {
public $verifyCode;
public  $needCapcha = false;

/**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Message the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'Message';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('sender_id, receiver_id, direction, date,  message', 'required'),
	    array('sender_id, receiver_id, readed', 'numerical', 'integerOnly' => true),
	    //array('', 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'),
	    array('direction', 'length', 'max' => 3),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, sender_id, receiver_id, direction, date, readed, message', 'safe', 'on' => 'search'),
	    array('verifyCode', 'required', 'on'=>'addnew', 'message'=>Yii::t('default','message.verifyCode.required')),
	    array('verifyCode', 'captcha', 'allowEmpty'=>(!extension_loaded('gd')||!$this->needCapcha)),
 	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'receiver' => array(self::BELONGS_TO, 'User', 'receiver_id'),
	    'sender' => array(self::BELONGS_TO, 'User', 'sender_id'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => 'ID',
	    'sender_id' => 'Sender',
	    'receiver_id' => 'Receiver',
	    'direction' => 'Direction',
	    'date' => 'Date',
	    'message' => 'Message',
	    'verifyCode' => Yii::t('default','AR.RentComment.capcha')
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
	$criteria->compare('sender_id', $this->sender_id);
	$criteria->compare('receiver_id', $this->receiver_id);
	$criteria->compare('direction', $this->direction, true);
	$criteria->compare('date', $this->date, true);
	$criteria->compare('message', $this->message, true);

	return new CActiveDataProvider($this, array(
		    'criteria' => $criteria,
		));
    }

    
}