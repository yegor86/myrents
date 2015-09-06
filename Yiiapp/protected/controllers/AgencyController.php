<?php
Yii::import('application.controllers.MyRentsController');
class AgencyController extends MyRentsController {

    public function actionIndex($id = 0) {
	$agency = Agency::model()->resetScope(true)
		->texted($this->curlang->id)
		//->with(array('creator','bannedIds','bannedUsers', 'adminsIds'))->findByPk($id);
		->with(array('creator'))->findByPk($id);
	//проверка доступности страницы агенства
	
	
	if (!$agency) {
	    header("HTTP/1.0 404 Not Found");
	    $this->assignAndRender('404_agency_not_found');
	} elseif ($agency->status == 'deleted') {
	    header("HTTP/1.0 410 Gone");
	    $this->assignAndRender('410_agency_was_deleted');
	}elseif($agency->status == 'new') {
	    header("HTTP/1.0 403 Forbidden");
	    $this->assignAndRender('waiting_for_modering');
	} //elseif ((!in_array(Yii::app()->user->id, $agency->adminIds)) && !in_array($agency->status, array('active', 'confirmed'))) {
	elseif ((Yii::app()->user->id!= $agency->creator->id) && !in_array($agency->status, array('active', 'confirmed'))) {
	    header("HTTP/1.0 403 Forbidden");
	    $this->assignAndRender('403_agency_access_not_permitted');
	} 
	//elseif(in_array(Yii::app()->user->id, $agency->bannedIds)) {
	   // header("HTTP/1.0 403 Forbidden");
	    //$this->assignAndRender('403_you_will_banned');
	//}
	    //все условия для возможности просмотреть объявление выполнены
	else{
	    //чтобы не догружать параметры агенство по отдельности каждое,
	    //выбираем агенство заново с полным списком необходимых значений
	    $view = (in_array(Yii::app()->user->id, $agency->adminIds))?'admin_agency':'user_agency';
	    
	    $params = array(
		'agency'=>$agency
	    );
	    $this->assignAndRender($view, $params);
	    
	    
	}
    }
    
    /**
     * Контроллер создания объявления
     */
    public function actionCreateAgency(){
	if(Yii::app()->user->isGuest){
	    header("HTTP/1.0 403 Forbidden");
	    $this->assignAndRender('you_not_logged');
	}else{
	  $form = new AgencyCreateForm();
	  if(isset($_POST['AgencyCreateForm'])){
	      $form->attributes=$_POST['AgencyCreateForm'];
	      if($form->validate()){
		  $agency = new Agency();
		  $agency->status = 'new';
		  $agency->save();  //сохраняем агенство  - получаем его IDшник
		  $agencyImage =  CUploadedFile::getInstance($form, 'image'); //сохраняем картинку агенства
		  if ($agencyImage) {
			$filename = $agency->id . '.' . $agencyImage->getExtensionName();
		  	$filename = ImageProcessing::image()
			->saveImage($agencyImage, $filename, 
				array('width' => 257,  'maindir' => Yii::app()->params['AGENCYIMAGESDIR'], 'overwrite' => true,
				    'thumb'=>array(
					array('width' => '40', 'height' => '40', 'resizeMinimal' => true, 'path'=>'little/'),
					array('width' => '70','height' => '70', 'resizeMinimal' => true),
				    )));
			$agency->image = $filename;
		  }
		  //сохраняе документ агенства
		  $agencyDoc =   CUploadedFile::getInstance($form, 'doc');
		  if($agencyDoc){
		      if(!is_dir(Yii::getPathOfAlias('webroot').Yii::app()->params['AGENCYDOCSDIR']))
			      mkdir(Yii::getPathOfAlias('webroot').Yii::app()->params['AGENCYDOCSDIR']);
		      $drToSave = Yii::getPathOfAlias('webroot').Yii::app()->params['AGENCYDOCSDIR'].$agency->id.'/';
		     if(!is_dir($drToSave)) mkdir ($drToSave);
		     
		     $agency->doc = $agencyDoc->getName();
		     if(is_file( $drToSave.$agency->doc)) unlink ($drToSave.$agency->doc);
		     $agencyDoc->saveAs($drToSave.$agencyDoc, true);
		  }
		  //сохраняем название на руск.яз
		  $agencyDescription = new AgencyDescription();
		  $agencyDescription->language_id =1;
		  $agencyDescription->agency_id=$agency->id;
		  $agencyDescription->name = $form->name;
		  $agencyDescription->description = $form->description;
		  $agencyDescription->save();
		  $agency->save();
		  $agency->addUser(Yii::app()->user->id, 'creator');
		  $this->redirect('/agency/'.$agency->id);
	      }
	  }
	    $this->assignAndRender('createAgency', array('model'=>$form));
	};
    }

    public function assignAndRender($view, $params = array()) {
        $this->assignControllerJsCss(
                array(
            'style.css',
            'tipTip.css',
            'jquery-ui-1.8.16.custom.css',
            'members.css',
            'jquery.fancybox.css'
                ), array(
            'menu.js',
            'jquery.tipTip.js',
            'jquery.jscrollpane.min.js',
            'jquery-ui-1.8.16.custom.min.js',
            'jquery.jcarousel.min.js',
            'jquery.tipTip.js',
            'somefunctions.js', 'jquery.fancybox.js',
                )
        );
        $this->render($view, $params);
    }
}
 