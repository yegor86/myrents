<?php

/**
 * This is the model class for table "RentDescription".
 *
 * The followings are the available columns in table 'RentDescription':
 * @property integer $language
 * @property integer $rent
 * @property string $name
 * @property string $overview
 * @property string $rules
 */
class RentDescription extends MRActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return RentDescription the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'RentDescription';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('name', 'required', 
		'message'=>Yii::t('default', 'message.RentDescription.name.required') ),
	    array('language, rent', 'numerical', 'integerOnly' => true),
	    array('name', 'length', 'max' => 130,
		'message'=>Yii::t('default', 'message.RentDescription.name.maxlength.130') ),
	    array('overview', 'length', 'max' => 1000,
		'message'=>Yii::t('default', 'message.RentDescription.overview.maxlength.1000') ),
	    array('rules', 'length', 'max' => 480,
		'message'=>Yii::t('default', 'message.RentDescription.rules.maxlength.480') ),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('language, rent, name, overview, rules', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'lang' => array(self::BELONGS_TO, 'Language', 'language'),
	    'rent_obj' => array(self::BELONGS_TO, 'Rent', 'rent'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'language' =>Yii::t('default','AR.RentDescription.language'),
	    'rent' => Yii::t('default','AR.RentDescription.rent'),
	    'name' => Yii::t('default','AR.RentDescription.name'),
	    'overview' =>Yii::t('default','AR.RentDescription.overview'), 
	    'rules' =>Yii::t('default','AR.RentDescription.rules')
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

	$criteria->compare('language', $this->language);
	$criteria->compare('rent', $this->rent);
	$criteria->compare('name', $this->name, true);
	$criteria->compare('overview', $this->overview, true);
	$criteria->compare('rules', $this->rules, true);

	return new CActiveDataProvider($this, array(
		    'criteria' => $criteria,
		));
    }

}