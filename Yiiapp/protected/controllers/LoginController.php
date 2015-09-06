<?php
Yii::import('application.controllers.MyRentsController');
class LoginController extends MyRentsController
{
    public function actionWrong(){
	if (Yii::app()->user->isGuest)	
	$this->assignAndRender('wrong_login');
	else 
	$this->redirect (Yii::app()->user->returnUrl);
    }
    
   
	public function actionLogin($service=false) {
		if ($service) {
   			$authIdentity = Yii::app()->eauth->getIdentity($service);
			
			$authIdentity->redirectUrl = Yii::app()->user->returnUrl;
                                     	//$authIdentity->cancelUrl = $this->createAbsoluteUrl('login/login');
                                                       $authIdentity->cancelUrl = $authIdentity->redirectUrl;
                                               
                                                       CustomFunctions::requestURIToGet();
					
			if ($authIdentity->authenticate()) {   
				$identity = new ServiceUserIdentity($authIdentity);
				// Успешный вход
				if ($identity->authenticate()) {
  					Yii::app()->user->login($identity,Yii::app()->params['SessionTime']);
					// Специальный редирект с закрытием popup окна
                                        
					$authIdentity->redirect();

				}
				else {
					// Закрываем popup окно и перенаправляем на cancelUrl
					$authIdentity->cancel();
				}
         
         
			} 
  			// Что-то пошло не так, перенаправляем на страницу входа
;
			$this->redirect(array('login/login')); 
		}
		Yii::import('application.extensions.portlet.XLoginPortlet');
			Yii::import('application.extensions.portlet.XPortlet');
			Yii::import('application.extensions.login.XLoginForm');
		    if(!Yii::app()->User->isGuest) $this->setUserInfo ();

		if(Yii::app()->request->isAjaxRequest){
			$this->widget('application.extensions.login.XLoginPortlet');
			if(!Yii::app()->User->isGuest) $this->setUserInfo ();
			Yii::app()->end();
		}
	}
    /**
     * подключение необходимых файлов и рендер
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params=array()) {
	$this->assignControllerJsCss(
		array(
	    'style.css',


		), array(
	    'menu.js',
	    'jquery.jscrollpane.min.js',
	    'jquery-ui-1.8.16.custom.min.js',
	    'jquery.tipTip.js',
	    'somefunctions.js',
                    'jquery.fancybox.js',
		)
	);
	$this->render($view, $params);
    }
}

?>
