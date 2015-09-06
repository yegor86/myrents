<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property integer $id
 * @property integer $created_on
 * @property string $title
 * @property string $context
 */
class Post extends MRActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return Post the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'post';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('created_on, title, context', 'required'),
	    array('created_on', 'numerical', 'integerOnly' => true),
	    array('title', 'length', 'max' => 255),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, created_on, title, context', 'safe', 'on' => 'search'),
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
	    'created_on' => 'Created On',
	    'title' => 'Title',
	    'context' => 'Context',
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
	$criteria->compare('created_on', $this->created_on);
	$criteria->compare('title', $this->title, true);
	$criteria->compare('context', $this->context, true);

	return new CActiveDataProvider($this, array(
		    'criteria' => $criteria,
		));
    }

}