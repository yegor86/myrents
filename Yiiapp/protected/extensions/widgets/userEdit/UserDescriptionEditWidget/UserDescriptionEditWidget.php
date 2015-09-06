<?php
Yii::import('application.extensions.widgets.userEdit.UserDescriptionEditWidget.UserDescriptionEditForm');

class UserDescriptionEditWidget extends BaseWidget {
    public $user=false;
    public function init() {
	    parent::init(__FILE__);
	    $this->addClientCsriptFiles();
    }
    public function run() {
	if(!Yii::app()->User->isGuest){
	//если данные пришли по запросу - создаём телефоны и валидируем
	$form = new UserDescriptionEditForm;
	if(isset($_POST['UserDescriptionEditForm'])){
	    $form->attributes = $_POST['UserDescriptionEditForm'];
	    if($form->validate()){
		if(!$this->user) $this->user = User::model ()->findByPk (Yii::app ()->User->id);
		$this->user->attributes = $form->attributes;
		$this->user->save();
		Yii::app()->user->setFlash('success', Yii::t('default', 'message.saved')); 
	    } else Yii::app()->user->setFlash('error', Yii::t('default', 'mesage.not.saved')); //иначе ошибка
	}
	//если данных постовых небло - берём существующие. 
	else $form->attributes = $this->user->attributes;
	
	
	if ($this->_fast) $this->render('UserDescriptionEdit',array('description'=>$form));
	else {
	echo('<div id="descriptionEditResult">');
	$this->render('UserDescriptionEdit',array('description'=>$form));
	echo('</div>');
	}
	} else throw new CHttpException(403, Yii::t('default','error.403.access.danied'));
    }

   private function addClientCsriptFiles(){
	$cs = Yii::app()->clientScript;
		    
	//$cs->registerScriptFile($this->_assetsUrl . '/js/jquery.imagetick.js', CClientScript::POS_HEAD);
	$cs->registerScriptFile($this->_assetsUrl . '/js/charCount.js', CClientScript::POS_HEAD);
    }

}

?>
