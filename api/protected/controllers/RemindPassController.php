<?php
Yii::import('application.controllers.MyRentsController');
/*
 * Активация учетной записи
 */

class RemindPassController extends MyRentsController {

/*
 * отправка эмайла
 */
    public function actionRemind() {
	if(Yii::app()->User->isGuest){
	    $remindForm = new RemindPassForm;
	    $view = 'remidInputEmail';
	    if(isset($_POST['RemindPassForm'])){
		$remindForm->attributes = $_POST['RemindPassForm'];
		if($remindForm->validate()&&$this->sendRemindPassKey($remindForm)){
		    Yii::app()->User->setFlash('success','flash.remind.key.was.sended');
		    $this->redirect('/remind/keysended');
		}
	    }
	    $this->assignAndRender($view,array('remindForm'=>$remindForm));
	}else $this->redirect ('/');
    }

    /**
     * сброс пароля
     * @param type $id
     * @param type $key 
     */
    public function actionResetPass($id = 0, $key = '') {
	//если указаны id  и ключ, иначе редирект на главную
	if ($id && $key) {
	    //если пользователь внезапно авторизирован, делаем ему насильный логаут
	    if (!Yii::app()->User->isGuest) {
		Yii::app()->cache->delete(Yii::app()->User->id . 'cachedUser');
		Yii::app()->user->logout();
	    }
	    $view = 'resetPass';
	    $variables = array();
	    $userReminder = UserRemindPass::model()->findByPk(array('user_id'=>$id,'key'=>$key)); 
	    if(!$userReminder) $view = 'errorKey'; //если нет ключа подтверждения - то вывод ошибки
	    else{
		$resetForm = new ResetPasswdForm();
		if($this->passChange($resetForm,$id)&&$this->loginWithNewPass($id)
			&&$userReminder->delete()) 
			$view = 'passChanged';
		$variables['resetForm']=$resetForm;
	    }
	    $this->assignAndRender($view,$variables);
	}else
	    $this->redirect('/');
    }
    
    
    /**
     * Авторизация после смены пароля
     * @return boolean 
     */
    private function loginWithNewPass($id) {
	$result = false;

	$user = User::model()->findByPk($id);
	if ($user) {
	    $identity = new UserIdentity($user->nick, $user->password);
	    if ($identity->authenticatenopass($user)) {
		Yii::app()->user->login($identity, Yii::app()->params['SessionTime']);
		$this->setUserInfo();
		$result = true;
	    }
	}
	return $result;
    }


    
    /**
     *отображение что пароль отправлен 
     */
    public function actionKeySended() {
	if (Yii::app()->User->isGuest) {
	    $this->assignAndRender('keySended');
	}else
	    $this->redirect('/');
    }
    
    /**
     *Смена паролей, много ифов потому-что проверки
     * @param type $resetForm
     * @param type $id
     * @return boolean 
     */
    private function passChange($resetForm, $id) {
	$result = false;
	if (isset($_POST['ResetPasswdForm'])) {
	    $resetForm->attributes = $_POST['ResetPasswdForm'];
	    if ($resetForm->validate()) {
		$user = User::model()->findByPk($id);
		if ($user) {
		    $user->password = md5($resetForm->passwd);
		    if ($user->save())
			$result = true;
		}
	    }
	}
	    return $result;
    }
    
    /**
     * генерация ключа
     * @param type $remindForm 
     */
    private function sendRemindPassKey($remindForm){
	$user = User::model()->with('passReminder')->findByAttributes(array('nick'=>$remindForm->email));
	if($user){
	    $key = ($user->passReminder)?$user->passReminder:new UserRemindPass;
	    $key->user_id = $user->id; // устанавливаем IDшник
	    $key->key = CustomFunctions::mkpasswd(12);
	    $mailparams = array(
		'recipier'=>$user->email,
		'link'=>$this->createAbsoluteUrl('/remind/' . $key->user_id . '/' . $key->key),
	    );
	    if($key->save()) $this->mail($mailparams); //если ключ создали (либо пересохранили) отправляем письмо
	}
	return true;          //возвращаем истину в любом случае, даже если такого имейла
			// нет и ключ не создан, для безопасности от брутфорса
    }
    
    /**
     * отправка письма на почту
     * @param type $mailparams
     * @return boolean 
     */
    private function mail($mailparams){
	$sender = Yii::app()->params['reminder_sender']; //отправитель (настраивается в параметрах)
	$recipier = $mailparams['recipier']; //получатель
	//хидер письма, указывается тип и кодировка, важно чтобы небыло кракозябров
	$header = "Content-type: text/plain; charset=utf-8 \r\n";
	$header.="From: $sender";
	//тема письма, установлен енкодер, важно чтобы небыло кракозябров
	$theme =  '=?UTF-8?B?'.base64_encode(Yii::t('default','remind.passwd.letter.theme')).'?=';
	
	//текст сообщения
	$message = Yii::t('default','remind.passwd.text.message {link}',array('{link}'=>$mailparams['link']));

	//непосредственная отправка сформированного письма
	mail($recipier,$theme,$message,$header);
	return true;
    }
    
    /**
     * подключение необходимых файлов и рендер
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params=array()) {
	$cssFiles = array(
	    'style.css',
	    'tipTip.css',
	    'slide.css',
	    'jquery-ui-1.8.16.custom.css',
	    'jquery.jscrollpane.css',
	    'cusel.css'
	);
	$jsFiles = array(
	    'menu.js',
	    'jquery.tipTip.js',
	    'jquery.jscrollpane.min.js',
	    'jScrollPaneSelect.js',
	    'jquery-ui-1.8.16.custom.min.js',
	    'jquery.jcarousel.min.js',
	    'somefunctions.js',
	    'jquery.imagetick.js',
	    'edit.js',
	    'cusel.js',
	    'charCount.js','jquery.fancybox.js',
	);

	$this->assignControllerJsCss($cssFiles, $jsFiles);
	$this->render($view, $params);
    }

}