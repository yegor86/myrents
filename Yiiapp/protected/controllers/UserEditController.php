<?php

/**
 * класс редактирования пользователя 
 * наследует класс польззователя
 */
Yii::import('application.controllers.UserController'); //подключаем класс пользователя

class UserEditController extends UserController {

    /**
     * страница редактирования данных о пользователе
     */
    public function actionEdit() {
	if (!Yii::app()->user->isGuest) {
	    $user = User::model()->with('language', 'language.lang')->findByPk(Yii::app()->user->id);
	    $var = array();
	    $var['langs'] = Language::model()->cache(Yii::app()->params['cachetime'])->findAll();
	    $var['user'] = $user;
	    $var['editform'] = new UserEditForm;
	    if (isset($_POST['UserEditForm'])) {
		$this->editUser($var);
	    } else {
		$var['editform']->attributes = $var['user']->attributes;
	    }
	    if (isset($_POST['Language'])) {
		$this->editLangs($var);
	    }
	    $var['langsArray'] = $this->modelsToArray($user->language, 'language');
	    if (Yii::app()->request->isAjaxRequest && $_POST['Language']){
		$this->renderPartial('_editLang', $var, false, true);
            }else
		$this->assignAndRender('edit', $var);
	}else
	    $this->redirect('/');
    }

    /**
     * сохранение языков пользователя
     *  
     */
    private function editLangs($var) {
	UserLang::model()->deleteAll('user = ' . $var['user']->id); //удаляем имеющиеся связи
	$langs = array();      //
	foreach ($var['langs'] as $key => $lang) { //перелистываем все языки
	    if (isset($_POST['Language'][$key]) && ($_POST['Language'][$key]['id'])) {  //если язык есть в выбранных, то 
		$newuserlang = new UserLang(); //создаём новую связь
		$newuserlang->language = $lang->id;
		$newuserlang->value = $_POST['UserLang'][$key]['value'];
		$newuserlang->user = Yii::app()->user->id;
		if ($newuserlang->save()) {
		    Yii::app()->user->setFlash('success', Yii::t('default', 'message.saved'));
		} else
		    Yii::app()->user->setFlash('error', Yii::t('default', 'mesage.not.saved')); //иначе ошибка
		$langs[] = $newuserlang;
	    }
	}
	$var['user']->language = $langs;
    }

    /**
     * сохранение изменений пользователя
     */
    private function editUser(&$var) {
	$tmpimage = $var['user']->image; //"третий стакан" для соранения картинки если она не будет перезагруженна
	$filename=false;
	$var['editform']->attributes = $_POST['UserEditForm'];
	if ($var['editform']->validate()) {
	    $var['user']->attributes = $var['editform']->attributes;
	    $file = CUploadedFile::getInstance($var['editform'], 'image');
	    if ($file) {
		$filename = Yii::app()->user->id . '.' . $file->getExtensionName();
		$filename = ImageProcessing::image()
			->saveImage($file, $filename, 
				array('width' => 257,  'maindir' => Yii::app()->params['USERPHOTOSDIR'], 'overwrite' => true,
				    'thumb'=>array(
					array('width' => '40', 'height' => '40', 'resizeMinimal' => true, 'path'=>'little/'),
					array('width' => '70','height' => '70', 'resizeMinimal' => true),
				    )));
		
	    } 
	$var['user']->image = $filename?$filename:$tmpimage;
	    $var['user']->skype = '';
	    if ($var['user']->save()){
		    Yii::app()->user->setFlash('success', Yii::t('default', 'message.saved'));
		} else
		    Yii::app()->user->setFlash('error', Yii::t('default', 'mesage.not.saved')); //иначе ошибка
	} $this->refresh ();
    }

    /**
     * запрос из виджета
     * @param classname $widget
     * @throws CHttpException 
     */
    public function actionWidget($widget) {
	$widgetname = $widget . 'Widget';
	//путь в фалу виджета
	$alias = 'application.extensions.widgets.userEdit.' . $widgetname . '.' . $widgetname;

	//проверяем на сущесвование
	if (is_file(Yii::getPathOfAlias($alias) . '.php')) {
	    //импорт файла
	    $classname = Yii::import($alias);
	    //подключение виджета
	    $widget = new $classname;
            $widget->init();
	    $widget->fastrun();
	}
	//если не найден - ошибка 404
	else
	    throw new CHttpException(404, Yii::t('default', 'error.404.page.not.found'));
    }

    
    /**
     *Изменение пароля 
     */
    public function actionChangepass() {
	if (!Yii::app()->user->isGuest) {
	    $user = User::model()->with('language', 'language.lang')->findByPk(Yii::app()->user->id);
	    if ($user->service != 'local')
		$this->redirect('/');
	    else {
		$UserCHPassForm = new UserCHPassForm();

		if (isset($_POST['UserCHPassForm'])) {
		    $UserCHPassForm->attributes = $_POST['UserCHPassForm']; //заносим в форму введённые данные
		    if (!$UserCHPassForm->validate())
			Yii::app()->user->setFlash('error', Yii::t('default', 'editpass.input.all.fields')); //если ошибка валлидации формы изменения пароля (к примеру не все поля заполнены или не соответсвуют)
		    elseif (md5($UserCHPassForm->oldpass) != $user->password)
			Yii::app()->user->setFlash('error', Yii::t('default', 'editpass.wrong.pass')); //если текущий пароль цуказан неверно
		    elseif ($UserCHPassForm->passwd != $UserCHPassForm->confirm)
			Yii::app()->user->setFlash('error', Yii::t('default', 'editpass.wrong.confirm')); //если текущий пароль указан верно но не совпадают новый пароль и подтверждение
		    else {  //все условия удовлетворены
			$user->password = md5($UserCHPassForm->passwd);
			if (!$user->save())
			    Yii::app()->user->setFlash('error', Yii::t('default', 'save.error'));
			else{
			    Yii::app()->user->setFlash('success', Yii::t('default', 'passwd.was.changed'));
			    
			}
		    } $this->refresh ();
		}
		$UserCHPassForm->unsetAttributes();  // Очиста формы от введённых ранее данных
		$this->assignAndRender('chpass', array('chpassform' => $UserCHPassForm, 'user' => $user));
	    }
	}else
	    $this->redirect('/');
    }

}

?>
