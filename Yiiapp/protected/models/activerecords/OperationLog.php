<?php

/**
 * This is the model class for table "OperationLog".
 *
 * The followings are the available columns in table 'OperationLog':
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property integer $operation_id
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Operation $operation
 */
class OperationLog extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return OperationLog the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'OperationLog';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('user_id, operation_id', 'required'),
	    array('user_id, operation_id', 'numerical', 'integerOnly' => true),
	    array('date', 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'),
	    array('comment', 'type', 'type' => 'string'),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, user_id, date, operation_id, comment', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'user' => array(self::BELONGS_TO, 'User', 'user_id'),
	    'operation' => array(self::BELONGS_TO, 'Operation', 'operation_id'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => 'ID',
	    'user_id' => 'User',
	    'date' => 'Date',
	    'operation_id' => 'Operation',
	    'comment' => 'Comment',
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
	$criteria->compare('user_id', $this->user_id);
	$criteria->compare('date', $this->date, true);
	$criteria->compare('operation_id', $this->operation_id);
	$criteria->compare('comment', $this->comment, true);

	return new CActiveDataProvider($this, array(
		    'criteria' => $criteria,
		));
    }

}