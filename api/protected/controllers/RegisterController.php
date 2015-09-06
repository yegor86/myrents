<?php
Yii::import('application.controllers.MyRentsController');
class RegisterController extends MyRentsController {

    public function actionRegister() {
	$model = new RegisterForm;
	$view = 'register';
	if (Yii::app()->user->isGuest) {
	    if (isset($_POST['RegisterForm'])) {

		$model->attributes = $_POST['RegisterForm'];
		if ($model->validate()) {
		    $user = new User;
		    $user->attributes = $_POST['RegisterForm'];
		    
		    //$user->nick = $model->email = mb_strtolower($model->email, 'utf-8');
		    $user->nick = $model->email;
		    $user->password = md5($user->password);
		    $user->member_since = date('Y-m-d H:i:s');
		    //TODO: после настройки почты убрать
		    $user->active=true;
		    $user->image='noimage.jpg';
		    if ($user->save()) {
			$userlang = new UserLang();
			$userlang->user = $user->id;
			$userlang->language = 1;
			$userlang->value = 3;
			$userlang->save();

			$confirmkey = new UserConfirmation;
			$confirmkey->user = $user->id;
			$confirmkey->key = CustomFunctions::mkpasswd(30);
			$confirmkey->save();
			$identity = new UserIdentity($user->nick, $model->password);
			if ($identity->authenticate()) {
			    Yii::app()->user->login($identity, Yii::app()->params['SessionTime']);
			    $this->setUserInfo();
			}
			$adminmail = Yii::app()->params['adminEmail'];
			$headers = "From: {$adminmail}\r\n";
			$emailbody = Yii::t('default','register.mail',
				array('{link}' => $this->createAbsoluteUrl('user/confirm') . '/' . $confirmkey->user . '/' . $confirmkey->key));
			mail($user->email, 'Confirm key', $emailbody, $headers);


			$view = 'registered';
		    }
		    else
			$model->addError('email', 'sorry, already exist');
		}
	    }
	}
	else
	    $this->redirect('/');

	$this->assignAndRender($view, array('model' => $model));
    }

    /**
     * подключение необходимых файлов и рендер
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params) {
	$this->assignControllerJsCss(
                array(
            'style.css',
            'jquery.fancybox.css',
                ), array(
            'menu.js',
            'jquery.fancybox.js',
                )
        );
	$this->render($view, $params);
    }

}