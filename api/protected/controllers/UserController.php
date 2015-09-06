<?php
Yii::import('application.controllers.MyRentsController');
class UserController extends MyRentsController {

    public function actions() {
	return array(
	    // captcha action renders the CAPTCHA image displayed on the contact page
	    'captcha' => array(
		'class' => 'CCaptchaAction',
		'backColor' => 0xFFFFFF,
	    ),
	    // page action renders "static" pages stored under 'protected/views/site/pages'
	    // They can be accessed via: index.php?r=site/page&view=FileName
	    'page' => array(
		'class' => 'CViewAction',
	    ),
	);
    }

    public function actionIndex() {
	$this->redirect('/');
    }

    /**
     * создаём массив, состоящий из определённого поля моделей
     * @param CActiveRecord[] $modelsarray
     * @param string $rowtoshow
     * @return String[] 
     */
    protected function modelsToArray($modelsarray = array(), $rowtoshow = 'id') {
	$result = array('id' => array(), 'keys' => array());
	foreach ($modelsarray as $key => $model) {
	    $result['id'][] = $model->$rowtoshow;
	    $result['keys'][$model->$rowtoshow] = $key;
	}
	return $result;
    }

    /**
     * Отображение информации о пользователе
     * @param type $id 
     */
    public function actionUser($id = 0) {
	$selfid = Yii::app()->user->id;
	$viewparams = array();
	if ($id == 0) {
	    $this->redirect('/');
	} else {
	    $view = 'user';
	    $viewparams['id'] = $id;
	    $viewparams['user'] = User::model()->findByPk($id);
	    if ($viewparams['user']) {
		if (!Yii::app()->user->isGuest && $selfid == $id) {
		    $view = 'mypage';
		}
		if (Yii::app()->request->isAjaxRequest)
		    $this->renderPartial('info_' . $view, $viewparams, false, true);
		else
		    $this->assignAndRender($view, $viewparams);
	    } else
		throw new CHttpException(404, 'page not found');
	}
    }

    /**
     * просмотр аренд
     * @param type $id
     * @throws CHttpException 
     */
    public function actionHostings($id = 0, $todourl=false) {
	if ($id) {
	    $view = ($id == Yii::app()->user->id) ? 'mypage_hostings' : 'user_hostings';
	    $viewparams['id'] = $id;
	    $viewparams['filter']=(isset($_POST['filter']))?(int)$_POST['filter']:0;
	    $lang = $this->curlang;
	    if (!Yii::app()->user->isGuest && $id == Yii::app()->user->id) {
		$Todos = Yii::app()->params['TodoUrl'];
		if(!$todourl) $todo=1;
		elseif(isset($Todos[$todourl]))
		    $todo = $Todos[$todourl];
		else {
		    throw new CHttpException(404, 'page not found');
		    Yii::app()->end();}
		$viewparams['todo'] = $todo;
		$viewparams['user'] = User::model()->findByPk($id);
		$criteria = new CDbCriteria(array(
			    'condition' => '`todo`=:todo AND `user`=:user AND `is_deleted` <> 1 ',
			    'params' => array(':todo' => $todo, ':user' => Yii::app()->user->id)));
		$criteria->order='`creation_date` DESC';
		if($viewparams['filter']){
		    $criteria->condition .= ' AND type=:type';
		    $criteria->params[':type']=$viewparams['filter'];
		}
		
		$viewparams['pagination'] = Rent::paginateCriteria($criteria,'Rent');
		$viewparams['rents'] = Rent::model()->with(array('photos', 'adress','currency',
			    'descriptions' => array(
				'select' => 'name',
				'params' => array(':lang' => $lang->id),
				'joinType' => 'LEFT OUTER JOIN ',
				'on' => '`descriptions`.`language`=:lang')
			))->findAll($criteria);
	    } else {   $viewparams['rents'] =false;
		$viewparams['pagination']=false;
		$viewparams['user'] = User::model()->findByPk($id);
		if ($viewparams['user']) {
		    $criteria = new CDbCriteria(array(
				'condition' => '`user`=:user AND `in_show` = 1 AND `is_deleted` <> 1 ',
				'params' => array(':user' => $id)));
		    $viewparams['pagination'] = Rent::paginateCriteria($criteria,'Rent');
		    $viewparams['rents'] = Rent::model()->with(
				    array(    'currency','adress',
					'descriptions' => array('on' => '`language` = ' . $lang->id),
					'photos')
			    )->findAll($criteria);
		}
	    }

	    if ($viewparams['user']) {
		if (Yii::app()->request->isAjaxRequest) {
		    $this->assignControllerJsCss(array('cusel.css'), array('upScript.js', 'jScrollPaneSelect.js', 'jquery.tipTip.js', 'cusel.js'));
		    $this->renderPartial('_' . $view, $viewparams, false, true);
		} else
		    $this->assignAndRender($view, $viewparams);
	    } else
		throw new CHttpException(404, 'page not found');
	} else
	    throw new CHttpException(404, 'page not found');
    }

    /**
     * просмотр друзей
     * @param type $id
     * @throws CHttpException 
     */
    public function actionFriends($id = 0) {
	throw new CHttpException(404, 'page not found');
    }
    
    
    public function actionHow_Place_Top($id = 0) {
        $viewparams['id'] = $id;
        		$viewparams['user'] = User::model()->findByPk($id);
		if (Yii::app()->request->isAjaxRequest) {
		    $this->assignControllerJsCss(array('cusel.css'), array('upScript.js', 'jScrollPaneSelect.js', 'jquery.tipTip.js', 'cusel.js'));
		    $this->renderPartial('_mypage_how_place_top', $viewparams, false, true);
		} else{
		    $this->assignAndRender('mypage_how_place_top', $viewparams);
                }
    }
    /**
     * просмотр избранного
     * @param type $id
     * @throws CHttpException 
     */
    public function actionFavorites($id = 0) {
	if ($id && ($id == Yii::app()->user->id)) {

	    //если был запрос на удаление
	    if (isset($_POST['unlink'])) {
		$fid = intval($_POST['fid']);
		$db = Yii::app()->db->createCommand()
			->delete('FavoritesRent', 'rent_id=:fid AND user_id =:uid ', array(':fid' => $fid, ':uid' => $id));
	    }



	    $view = 'mypage_favorites';
	    $viewparams['user'] = User::model()->with(array(
			'favorites',
			'favorites.descriptions' => array('on' => '`language` = ' . $this->curlang->id),
			'favorites.photos'
		    ))
		    ->findByPk($id);
	    if (Yii::app()->request->isAjaxRequest) {
		$this->assignControllerJsCss(array('cusel.css'),array('upScript.js','jScrollPaneSelect.js','cusel.js'));
		
		$this->renderPartial('_' . $view, $viewparams, false, true);
	    } else
		$this->assignAndRender($view, $viewparams);
	} else
	    throw new CHttpException(404, 'page not found');
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
	    'tipTip.css',
	    'slide.css',
	    'jquery-ui-1.8.16.custom.css',
	    'jquery.jscrollpane.css',
	    'cusel.css',
	    'jquery.fancybox.css',
		), array(
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
	    'charCount.js',
	    'jquery.multi-accordion-1.5.3.js',
	    'accordion_no.js',
	    'MRAjaxLibrary.js',
	    'jquery.fancybox.js',
	    'jquery.keyboard.js',
		    'upScript.js' //скрипт для апов
		)
	);
	$this->render($view, $params);
    }

}
