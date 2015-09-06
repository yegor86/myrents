<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $id
 * @property string $nick
 * @property string $email
 * @property string $password
 * @property integer $role
 * @property integer $active
 * @property string $firstname
 * @property string $lastname
 * @property string $phone
 * @property integer $login_fails
 * @property string $service
 * @property string $image
 * @property string $member_since
 * @property string $last_worked
 * @property string $skype
 *
 * The followings are the available model relations:
 * @property Rent[] $rents
 * @property UserConfirmation $userConfirmation
 * @property UserLang[] $userLangs
 * @property RentComment[] $posts
 */
class User extends MRActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'User';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('nick', 'required'),
	    array('overview', 'length', 'max' => '600'),
	    array('active, login_fails', 'numerical', 'integerOnly' => true),
	    array('nick, email, password, firstname, lastname', 'length', 'max' => 250),
	    array('email', 'match', 'pattern' => '/^[\da-z][-_\d\.a-z]*@(?:[\da-z][-_\da-z]*\.)+[a-z]{2,5}$/iu',
		'message' => Yii::t('default', 'message.RegisterForm.not.valid.email.entered')),
	    array('nick', 'unique',
		'message' => Yii::t('default', 'message.RegisterForm.nick.is.nit.unique')),
	    array('last_worked, member_since', 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'),
	    array('role, service, image, skype', 'length', 'max' => 50),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, nick, email, password, role, active, firstname, lastname, phone, login_fails, service, image, member_since, last_worked, skype', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'rents' => array(self::HAS_MANY, 'Rent', 'user',
	    		'condition'=>'`is_deleted` <> 1'),
	    'userConfirmation' => array(self::HAS_ONE, 'UserConfirmation', 'user'),
	    'apiKey' => array(self::HAS_ONE, 'UserApiKey', 'user_id'),
	    'language' => array(self::HAS_MANY, 'UserLang', 'user'),
	    'langs' => array(self::MANY_MANY, 'Language', 'UserLang(user, language)'),
	    'posts'=>array(self::HAS_MANY, 'RentComment', 'sender_id'),
	    'recived_mail' => array(self::HAS_MANY, 'Message', 'receiver_id'),
	    'sended_mail' => array(self::HAS_MANY, 'Message', 'sender_id'),
	    'not_readed_mail'=>array(self::HAS_MANY, 'Message', 'receiver_id',
		'condition'=>'readed = 0 AND direction = \'in\'',
		),
	    'favorites'=>array(self::MANY_MANY, 'Rent','FavoritesRent(user_id,rent_id)',
	    		'condition'=>'`is_deleted` <> 1'
		),
	    'passReminder'=>array(self::HAS_ONE,'UserRemindPass','user_id'),
	    'operations' => array(self::HAS_MANY, 'OperationLog', 'user_id'),
	    'today_ups' => array(self::HAS_MANY, 'OperationLog', 'user_id',
		'condition'=>'date > :date AND operation_id = 1',
		'params'=>array(':date'=>date('Y-m-d'))
		),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => 'ID',
	    'nick' => 'Nick',
	    'email' => 'Email',
	    'password' => 'Пароль (md5)',
	    'role' => 'Поль',
	    'active' => 'Active',
	    'firstname' => 'Имя',
	    'lastname' => 'Фамилия',
	    'phone' => 'Телефон',
	    'login_fails' => 'Login Fails',
	    'service' => 'Service',
	    'image' => 'Image',
	    'member_since' => 'Member Since',
	    'last_worked' => 'Last Worked',
	    'skype' => 'Skype',
	    'overview' => 'Описание'
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
	$criteria->compare('nick', $this->nick, true);
	$criteria->compare('email', $this->email, true);
	$criteria->compare('password', $this->password, true);
	$criteria->compare('role', $this->role);
	$criteria->compare('active', $this->active);
	$criteria->compare('firstname', $this->firstname, true);
	$criteria->compare('lastname', $this->lastname, true);
	$criteria->compare('phone', $this->phone, true);
	$criteria->compare('login_fails', $this->login_fails);
	$criteria->compare('service', $this->service, true);
	$criteria->compare('image', $this->image, true);
	$criteria->compare('member_since', $this->member_since, true);
	$criteria->compare('last_worked', $this->last_worked, true);
	$criteria->compare('skype', $this->skype, true);
	$criteria->compare('overview', $this->overview, true);
	return new CActiveDataProvider($this, array(
		    'criteria' => $criteria,
		));
    }
    
    
    
    public function getActiveUpsCount(){
	$result =Yii::app()->params['freeUpsByDay'];
	$criteria = new CDbCriteria();
	$criteria->condition = 'operation_id=1';
	//$criteria->condition = 'date > :date and operation_id=1';
	//$criteria->params=array(':date'=>date('Y-m-d 00:00:00'));
	$operationsToday = $this->today_ups;
	if(count($operationsToday)) $result-=count($operationsToday);
	if($result<0)$result=0;
	return $result;
    }
    
    ///////////////////////////////////////////////////
    ///дополнительные функции  и переменные////
    ///////////////////////////////////////////////////
    
    const NOTIFY_VARIABLE = 0;		//разнообразное (нетипизированное) сообщение
    const NOTIFY_RENT_COMMENT = 1;	//тип оповещения 1 - оповещение о комментарие на странице
    const NOTIFY_RECIVED_MESSAGE = 2;	//2- оповещение о полученном сообщении
    
    
    
    /**
     * отправка штучного уведомления пользователю
     * @param string $message
     * @return boolean 
     */
    public function notify($message){
	$result=false;
	if($this->CheckNotificationAccess(self::NOTIFY_VARIABLE)) $result = Notificator::ST()->sendNotification($this, $message);
	return $result;
    }
    
    /**
     * отправка стандартных уведомлений (о новом комментарие, о полученом собщении. т.д.)
     * @param type $params
     * @param type $type 
     */
    public function staticNotify($type = self::NOTIFY_RENT_COMMENT,$params=array()){
	$result=false;
	if($this->CheckNotificationAccess($type)){
	    $message = Yii::t('messages','notifymessage'.$type,$params);
	    $result = Notificator::ST()->sendNotification($this, $message);
	}
	return $result;
    }
    
    /**
     * проверяет, можно ли отправить уведомление данного типа
     * @param integer $type
     * @return boolean 
     */
    public function CheckNotificationAccess($type =  self::NOTIFY_VARIABLE){
	return true;
    }
    
    
}