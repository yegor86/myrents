<?php

/**
 * This is the model class for table "Partner".
 *
 * The followings are the available columns in table 'Partner':
 * @property integer $id
 * @property string $image
 * @property string $url
 * @property integer $ord
 */
class Partner extends PageRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Partner the static model class
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
		return 'Partner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('url', 'required'),
			array('ord', 'numerical', 'integerOnly'=>true),

                    array('image, url', 'length', 'max'=>250),
                        array('image', 'file', 'types'=>'jpg, jpeg, gif, png, JPG, JPEG, GIF, PNG', 'allowEmpty' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, image, url, ord', 'safe', 'on'=>'search'),
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
		    'translations' => array(self::HAS_MANY, 'Translations', 'row_id',
			    'condition'=>'table_key = \'Partner\'',
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'image' => 'Image 140x90',
			'url' => 'Url',
			'ord' => 'Ord',
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
		$criteria->compare('image',$this->image,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('ord',$this->ord);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}