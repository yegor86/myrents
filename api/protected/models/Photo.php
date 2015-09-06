<?php

/**
 * This is the model class for table "Photo".
 *
 * The followings are the available columns in table 'Photo':
 * @property integer $id
 * @property integer $rent
 * @property string $name
 * @property string $file
 */
class Photo extends MRActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return Photo the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'Photo';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('rent, file', 'required'),
	    array('rent', 'numerical', 'integerOnly' => true),
	    array('name, file', 'length', 'max' => 250),
	    array('cover', 'boolean'),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, rent, name, file, cover', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'Orent' => array(self::BELONGS_TO, 'Rent', 'rent'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => 'ID',
	    'rent' => 'Rent',
	    'name' => 'Name',
	    'file' => 'File',
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
	$criteria->compare('rent', $this->rent);
	$criteria->compare('name', $this->name, true);
	$criteria->compare('file', $this->file, true);
	$criteria->compare('cover', $this->cover);
	return new CActiveDataProvider($this, array(
		    'criteria' => $criteria,
		));
    }

    /**
     * установка обложки 
     */
     
    public function setCover(){
	//проверяем владельца
	    $criteria = new CDbCriteria();
	    $criteria->condition = 'rent = :rent_id';
	    $criteria->params = array(':rent_id'=>$this->rent);
	    Photo::model()->updateAll(array('cover'=>0), $criteria); //сбрасываем флаг обложки со всех имеющихся фото объявления
	    $this->cover = 1;
	    $this->update(array('cover')); //устанавливаем обложку
    }
    
}