<?php
class ServiceUserIdentity extends UserIdentity {
    const ERROR_NOT_AUTHENTICATED = 3;

    /**
     * @var EAuthServiceBase the authorization service instance.
     */
    protected $service;

    /**
     * Constructor.
     * @param EAuthServiceBase $service the authorization service instance.
     */
    public function __construct($service) {
        $this->service = $service;
    }

    /**
     * Authenticates a user based on {@link username}.
     * This method is required by {@link IUserIdentity}.
     * @return boolean whether authentication succeeds.
     */



    public function authenticate() {
	$servicename = $this->service->serviceName;
	$nick = $this->service->serviceName . $this->service->getAttribute('id');
	if ($this->service->isAuthenticated) {
	    $userRecord = User::model()->findByAttributes(array('nick' => $nick));
	    //если пользователя ещё нет - создаём
	    if (!$userRecord) $userRecord = $this->createUser($nick);
	    //применение пользователя к системе
	    $this->applyUser($userRecord);
	    $this->errorCode = self::ERROR_NONE;
	} else {
	    $this->errorCode = self::ERROR_NOT_AUTHENTICATED;
	}
	return !$this->errorCode;
    }
    
    /*
     * применение найденного\созданного пользователя к системе
     */
    private function applyUser($userRecord){
	    $this->username = $userRecord->firstname;
	    $this->_id = $userRecord->id;
	    $this->setState('id', $userRecord->id);
	    $this->setState('name', $this->username);
	    $this->setState('roles', $userRecord->role);
	    $this->setState('service', $userRecord->service);	
    }
    
    /*
     * создание пользователя если новый
     */
    private function createUser($nick) {
	$newUser = new User;
	$tmpname = array();
	preg_match('/^([^\s]+)\s*(.*)?$/', $this->service->getAttribute('name'), $tmpname); //разделение имени по запчастям
	$newUser->firstname = $tmpname[1];
	$newUser->lastname = $tmpname[2];
	$newUser->nick = $nick;
	$newUser->active = true;
	$newUser->service = $this->service->serviceName;
	$newUser->image = $this->getImage($this->service);
	$newUser->member_since = date('Y-m-d H:i:s');
	$newUser->save();
	$newUserLang = new UserLang();
	$newUserLang->user = $newUser->id;
	$newUserLang->language = 1;
	$newUserLang->value = 3;
	$newUserLang->save();
	return $newUser;
    }
    
    /** получение изображения при регистрации от внешний ссылок
     *
     * @param type $service
     * @return string 
     */
    private function getImage($service) {
	$result = 'noimage.jpg';
	$url = false;
	$id = $service->getAttribute('id');
	/**https://graph.facebook.com/<?= $fid ?>/picture?type=large**/
	if ($service->serviceName == 'vkontakte') {
	    $client_id = Yii::app()->eauth->services[$service->serviceName]['client_id'];
	    $client_secret = Yii::app()->eauth->services[$service->serviceName]['client_secret'];
	    $vk = new vkapi($client_id, $client_secret);
	    $resp = $vk->api('users.get', array('uids' => $id, 'fields' => 'photo_big'));
	    if (isset($resp['response'][0]['photo_big'])) { //если получили урл с картинкой
		$url = (string) $resp['response'][0]['photo_big'];
	    }
	}elseif($service->serviceName == 'facebook'){
	    $url = "http://graph.facebook.com/$id/picture?type=large";
	}
	
                  if($url){
		$downloadedPhoto = new FileFromUrl($url);
		$filename = $service->getAttribute('id') . '.jpg';
		$result = ImageProcessing::image()
			->saveImage($downloadedPhoto, $filename, array(
		    'width' => 257,
		    'maindir' => Yii::app()->params['USERPHOTOSDIR'],
		    'thumb' => array(
			array('width' => '40', 'height' => '40', 'resizeMinimal' => true, 'path' => 'little/'),
			array('width' => '70', 'height' => '70', 'resizeMinimal' => true),
			)));
	    }

	return $result;
    }

}
?>