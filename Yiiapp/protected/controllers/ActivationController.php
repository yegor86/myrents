<?php

/*
 * Активация учетной записи
 */
Yii::import('application.controllers.MyRentsController');
class ActivationController extends MyRentsController {


    public function actionActivation($id = 0, $key = '') {
	if ((!Yii::app()->user->isGuest) && (Yii::app()->user->id != $id)) {
	    $this->redirect('/');
	} else {
	    $confirm = UserConfirmation::model()->findByAttributes(array('user' => $id, 'key' => $key));
	    if ($confirm !== null) {
		$user = User::model()->findByAttributes(array('id' => $confirm->user));
		Yii::app()->cache->delete($confirm->user . 'cachedUser');
		
		$user->active = true;
		$user->save();
		$confirm->delete();
		$identity = new UserIdentity($user->nick, $user->password);
		if ($identity->authenticatenopass($user)) {
		    Yii::app()->user->login($identity, Yii::app()->params['SessionTime']);
		    $this->setUserInfo();
		}
		$this->assignAndRender('confirmed');
	    } else
		$this->assignAndRender('noconfirmed');
	}
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