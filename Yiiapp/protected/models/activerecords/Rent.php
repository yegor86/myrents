<?php
/**
 * This is the model class for table "Rent".
 *
 * The followings are the available columns in table 'Rent':
 * @property integer $id
 * @property integer $user
 * @property double $ratio
 * @property integer $type
 * @property integer $todo
 * @property double $price_day
 * @property double $price_week
 * @property double $price_month
 * @property string $floor
 * @property integer $in_show
 * @property integer $rooms_count
 * @property double $square
 * @property integer $amenity_bitmask
 * @property integer $neiborhood_bitmask
 * @property integer $current_price
 * @property integer $currency_id
 * @property integer $is_deleted
 * @property integer $updatePeriod
 * @property DateTime $last_up
 * @property DateTime $creation_date
 * 
 * The followings are the available model relations:
 * @property Adress[] $adresses
 * @property Amenity[] $amenities
 * @property Neighbor[] $neighbors
 * @property Photo[] $photos
 * @property Todo $todo0
 * @property User $user0
 * @property Type $type0
 * @property Language[] $languages
 * @property RentComment[] $comments
 */

class Rent extends MRActiveRecord {

    /**
     * добавляем екстеншн для сохранения связей
     * @return type 
     */
    public function behaviors() {
	return array('CSaveRelationsBehavior' => array('class' => 'application.components.CSaveRelationsBehavior'));
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Rent the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }
    
    public function defaultScope() {
	return array(
	    'condition' => "`is_deleted`=0",
	);
    }
    
    public function scopes() {
	return array(
	    'hidden'=>array(
		'condition'=>'`in_show` = 0'
	    ),
	    'is_full'=>array(
                
		'condition'=>'
		 in_show =1 
		 AND is_deleted = 0
		 AND (CASE  `current_price` 
		   WHEN 1 THEN `index_price_day`
		   WHEN 2 THEN `index_price_week`
		   WHEN 3 THEN `index_price_month`
		   END)>0
		 AND EXISTS (SELECT `name` FROM `Adress` WHERE `rent_id` = '.$this->getTableAlias().'.`id`)
		 AND EXISTS (SELECT `rent` FROM `RentDescription` WHERE `RentDescription`.`rent` = '.$this->getTableAlias().'.`id`)
		 ',
		
	    ),
	    'any'=>array(
		'condition'=>'`is_deleted`=1 OR `is_deleted`=0'
	    )
	);
    }
    
    public function texted($langId=1)
	    { 
		$this->getDbCriteria()->mergeWith(array(
		    'with'=>array('curdescription'=>array('params'=>array(':lang'=>$langId)),'rudescription')
		));
		return $this;
	    }
            
    public function fullparms($langId=1)
	    { 
	$this->getDbCriteria()->mergeWith(array(
	    'with'=>array('photos', 'adress','currency','cover', 
		'curdescription'=>array('params'=>array(':lang'=>$langId)),
		'rudescription'
                        ),
		));
		return $this;
	    }
	    
     public function mostComplete($langId=1){
  		$this->getDbCriteria()->mergeWith(array(
		    'with'=>array('photos', 'adress','currency','rent_type','currency','rent_todo',
                        'amenities','neighbors','cover',
                        'curdescription'=>array('params'=>array(':lang'=>$langId)),'rudescription'
                        ),
		));
		return $this;       
     }

     /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'Rent';
    }

    public function getIsFull(){
	$result = (!isset($this->adress->name)||(!($this->price_day||$this->price_week||$this->price_month)))?false:true;
	return $result;
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('user, type, todo, in_show, is_deleted, rooms_count, neiborhood_bitmask, amenity_bitmask, floor', 'numerical', 'integerOnly' => true),
	    array('show_in_main','boolean'),
	    array('ratio, square', 'numerical', 'min'=>0,
		'message'=>Yii::t('default','message.Rent.value.cannot.be.negative')),
	    array('current_price', 'in', 'range' => array('1', '2', '3')),
	    array('currency_id', 'in', 'range' => array('1', '2', '3','4')),
	    array('creation_date, last_up, last_modify', 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'),
	    array('price_day, price_week, price_month, index_price_day, index_price_week, index_price_month', 'numerical', 'max'=>99999999, 'min'=>0),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, user, ratio, type, todo, price_day, price_week, price_month, index_price_day, index_price_week, index_price_month, current_price, currency_id, floor, in_show, is_deleted, rooms_count, square, creation_date, show_in_main, last_modify', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'adress' => array(self::HAS_ONE, 'Adress', 'rent_id'),
	    'top' => array(self::HAS_ONE, 'Top', 'rent_id','condition'=>'action=\'t\''),
	    'atmain' => array(self::HAS_ONE, 'Top', 'rent_id','condition'=>'action=\'m\''),
	    'amenities' => array(self::MANY_MANY, 'Amenity', 'AmenityRent(rent, amenity)'),
	    'neighbors' => array(self::MANY_MANY, 'Neighbor', 'NeighborRent(rent, neighbor)'),
	    'photos' => array(self::HAS_MANY, 'Photo', 'rent'),
	    'rent_todo' => array(self::BELONGS_TO, 'Todo', 'todo'),
	    'renter' => array(self::BELONGS_TO, 'User', 'user'),
	    'rent_type' => array(self::BELONGS_TO, 'Type', 'type'),
	    'languages' => array(self::MANY_MANY, 'Language', 'RentDescription(rent, language)'),
	    'descriptions' => array(self::HAS_MANY, 'RentDescription', 'rent'),
	    'comments'=>array(self::HAS_MANY, 'RentComment', 'receiver_id'),
	    'tempSms'=>array(self::HAS_MANY, 'TempSMS', 'rent_id'),
	    'subscriber'=>array(self::MANY_MANY, 'User', 'FavoritesRent(rent_id, user_id)'),
	    'currency'  => array(self::BELONGS_TO, 'Currency', 'currency_id'),
	    'cover' =>  array(self::HAS_ONE, 'Photo', 'rent', 'on'=>'`cover`.`cover` = 1',),
                      'curdescription'=>array(self::HAS_ONE, 'RentDescription', 'rent', 'on'=>'`curdescription`.language=:lang'),
	    'rudescription'=>array(self::HAS_ONE, 'RentDescription', 'rent', 'on'=>'`rudescription`.language=1'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => 'ID',
	    'user' => 'User',
	    'ratio' => 'Ratio',
	    'type' => 'Type',
	    'todo' => 'Todo',
	    'price_day' => 'Price Day',
	    'price_week' => 'Price Week',
	    'price_month' => 'Price Month',
	    'floor' => 'Floor',
	    'in_show' => 'In Show',
	    'rooms_count' => 'Rooms Count',
	    'square' => 'Square',
	    'current_price' => 'Price selection'
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
	$criteria->compare('user', $this->user);
	$criteria->compare('ratio', $this->ratio);
	$criteria->compare('type', $this->type);
	$criteria->compare('todo', $this->todo);
	$criteria->compare('price_day', $this->price_day);
	$criteria->compare('price_week', $this->price_week);
	$criteria->compare('price_month', $this->price_month);
	$criteria->compare('index_price_day', $this->index_price_day);
	$criteria->compare('index_price_week', $this->index_price_week);
	$criteria->compare('index_price_month', $this->index_price_month);
	$criteria->compare('current_price', $this->current_price);
	$criteria->compare('floor', $this->floor, true);
	$criteria->compare('in_show', $this->in_show);
	$criteria->compare('rooms_count', $this->rooms_count);
	$criteria->compare('square', $this->square);
	$criteria->compare('amenity_bitmask', $this->amenity_bitmask);
	$criteria->compare('neiborhood_bitmask', $this->neiborhood_bitmask);
	$criteria->compare('creation_date',$this->creation_date);
	$criteria->compare('last_up',$this->last_up);
	$criteria->compare('is_deleted',$this->is_deleted);
	$criteria->compare('last_modify', $this->last_modify);
	return new CActiveDataProvider($this, array(
		    'criteria' => $criteria,
		));
    }

    /**
     * Сохранение связанных данных - описаний аренд, после созранения самой аренды
     */
    public function saveDescriptions($new = false) {
	foreach ($this->descriptions as $description) {
	    $description->rent = $this->id;
	    if (!$new) {
		$description->isNewRecord = false;
	    }
	    $description->save();
	}
	$this->last_modify =  date("Y-m-d H:i:s");
	$this->update(array('last_modify')); //после пересохранения описаний изменяем дату обновления
    }

    /**
     * проверка на полноту объявления (т.е. заполнены все поля)
     * @return boolean 
     */
    public function isCompleted($checkImages = false){
	$result = false;
	if($this->isFull&&$this->in_show&&!$this->is_deleted) $result = true;
	if($checkImages&&!count($this->photos)) $result = false;
	return $result;
    }
    
    /** 
     * пометить как удалённое
     * @return boolean 
     */
    public function markAsDeleted(){
	$this->is_deleted = true;
	return $this->save();
    }
    /**
     * восстановить из удалённого 
     * @return boolean 
     */
    public function restore(){
	$this->is_deleted = false;
	return $this->save();
    }
    
    /**
     * получает описание в текущей локали,
     * если его нет, то русскую
     * @return RentDescription 
     */
    public function getDescription(){
	    return ($this->curdescription)?$this->curdescription:$this->rudescription;
    }
    
    /**
     * выдаёт числено время с последнего обновления аренды
     * @return integer
     */
    public function getUpdatePeriod(){
	$daysAfterUpdate=floor((time()-strtotime($this->creation_date))/86400);
	$result = CustomFunctions::checkInArrayPeriod($daysAfterUpdate, Yii::app()->params['updatePeriods']);
	return $result;
    }
    
    /**
     *сбрасывание обложки 
     */
    public function resetCover(){
	if(!$this->cover&&isset($this->photos[0])){ //только если текущей обложки нет и есть другие фото
	    $photo = $this->photos[0];
	    $photo->cover = 1;
	    $photo->save();
	}else{
	    echo('no photos');die();
	}
    }
}

