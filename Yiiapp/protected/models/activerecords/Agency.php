<?php

/**
 * This is the model class for table "Agency".
 *
 * The followings are the available columns in table 'Agency':
 * @property integer $id
 * @property string $status
 * @property string $image
 *
 * The followings are the available model relations:
 * @property integer[] $bannedIds
 * @property User $creator
 * @property Language[] $languages
 * @property User[] $users
 * @property User[] $bannedUsers
 * @property User[] $waitingUsers
 * @property User[] $members
 * @property User[] $adminUsers
 */
class Agency extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Agency the static model class
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
		return 'Agency';
	}

	public function scopes(){
	    return array(
		'active'=>array(
		    'condition'=>$this->getTableAlias(). ".`status` NOT IN ('inactive','closed','deleted')"
		    ),
	    );
	}
	
	public function texted($langId=1)
	    { 
		$this->getDbCriteria()->mergeWith(array(
		    'with'=>array('curdescription'=>array('params'=>array(':lang'=>$langId)),'rudescription')
		));
		return $this;
	    }

	    
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'length', 'max'=>8),
			array('image', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, status, image', 'safe', 'on'=>'search'),
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
			'languages' => array(self::MANY_MANY, 'Language', 'AgencyDescription(agency_id, language_id)'),
		    'descriptions' => array(self::HAS_MANY, 'AgencyDescription', 'agency_id'),
			'users' => array(self::MANY_MANY, 'User', 'AgencyUser(agency_id, user_id)'),
		    'curdescription'=>array(self::HAS_ONE, 'AgencyDescription', 'agency_id', 'condition'=>'`curdescription`.language_id=:lang'),
		    'rudescription'=>array(self::HAS_ONE, 'AgencyDescription', 'agency_id', 'condition'=>'`rudescription`.language_id=1'),
		//    'creator'=>array(self::BELONGS_TO,'User', 'creator'),
		      'creator'=>array(self::STAT,'User','AgencyUser(agency_id, user_id)', 'select'=>'id', 'condition'=>'`status`="creator"'),
		//    'bannedIds'=>array(self::STAT,'User','AgencyUser(agency_id, user_id)','select'=>'id' ,'condition'=>'`status`="banned"'),
		//    'adminsIds'=>array(self::STAT,'User','AgencyUser(agency_id, user_id)', 'select'=>'id','condition'=>'`status` IN ("admin","creator")'),
		    'bannedUsers'=>array(self::MANY_MANY,'User','AgencyUser(agency_id, user_id)', 'on'=>'`bannedUsers_bannedUsers`.`status`="banned"'),
		    'waitingUsers'=>array(self::MANY_MANY,'User','AgencyUser(agency_id, user_id)', 'on'=>'`waitingUsers_waitingUsers`.`status`="waiting"'),
		    'members'=>array(self::MANY_MANY,'User','AgencyUser(agency_id, user_id)', 'on'=>'`members_members`.`status` IN ("member","admin","creator")','with'=>'agencyCount'),
		    'adminUsers'=>array(self::MANY_MANY,'User','AgencyUser(agency_id, user_id)', 'on'=>'`adminUsers_adminUsers`.`status` IN ("admin","creator")'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'status' => 'Status',
			'image' => 'Image',
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
		$criteria->compare('status',$this->status,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	//получение описания, во вью используется конструкция $agency->description
	public function getDescription(){
	    return ($this->curdescription)?$this->curdescription:$this->rudescription;
	}
	
    /**
     * добавляет\обновляет одиносчную связь с пользователем
     * @param integer $id  Users id
     * @param enum('banned','waiting','member','admin','creator') $status status
     */
    public function addUser($id, $status = 'waiting') {
	return $dbCommand = Yii::app()->db->createCommand()
		->insertUpdate('AgencyUser', 
		    array(
			'agency_id' => $this->id,
			'user_id' => $id,
			'status' => $status), 
		    array(
			'status' => $status
		    ));
    }
}