<?php
Yii::import('application.controllers.RentEditMainController');
class RentEditPhotosController extends RentEditMainController {

    
    public function actions()
    {
        return array(
            'upload'=>array(
                'class'=>'xupload.actions.XUploadAction',
                'path' =>Yii::getPathOfAlias('webroot') .  Yii::app()->params['RENTPHOTOSDIR'].Yii::app()->getRequest()->getQuery('id'),
                'publicPath' => Yii::app() -> getBaseUrl() . Yii::app()->params['RENTPHOTOSDIR'].Yii::app()->getRequest()->getQuery('id'),
                'subfolderVar'=>false
            ),
        );
    }
    
    
     public function actionDelete($id=0,$photoid){
	$image = Photo::model()->findByPk($photoid);
	if ($image) {
	    if ($image->rent = $id) {
		ImageProcessing::image()->dropImage($image->file, Yii::app()->params['RENTPHOTOSDIR'] . $id . '/');
		$image->delete();
		header('Content-type: application/json');
		echo json_encode(true);
	    }
	}else echo json_encode(false);
    }
	
	
    public function actionUploadget($id=0){
        $rent = Rent::model()->with('photos')->findByPk($id,'`is_deleted` <> 1');
        $resArray=array();
        foreach($rent->photos as $photo){
            $resArray[] = array(
                'name'=>$photo->file,
                'photoid'=>$photo->id,
                'delete_type'=>'DELETE',
                'delete_url'=>'photos/delete/'.$photo->id,
		'photo_id'=>$photo->id,
                'cover'=>$photo->cover,
                'url'=>Yii::app() -> getBaseUrl() . Yii::app()->params['RENTPHOTOSDIR'].Yii::app()->getRequest()->getQuery('id'),
                'thumbnail_url'=>Yii::app() -> getBaseUrl() . Yii::app()->params['RENTPHOTOSDIR'].Yii::app()->getRequest()->getQuery('id').'/thumbs/'.$photo->file,
            );
        }
        header('Content-type: application/json');          
        $JSONPhotos=json_encode($resArray);
               
        echo $JSONPhotos;
    }

    /*
     * установка обложки
     */
    private function cover($id){
	    $photo = Photo::model()->findByPk($_POST['cover']);
	    //TODO: вызвать ексепшн
	    if((isset($photo->Orent->user)&&$photo->Orent->user == Yii::app()->user->id) || $this->user->role=='admin')
	    $photo->setCover();
    }
    
    public function actionEdit($id = 0) {
	if(isset($_POST['cover'])) {   $this->cover($id);}else{
	
        Yii::import("xupload.models.XUploadForm");
        $model = new XUploadForm;
	$model->id = $id;
	$rent = Rent::model()->with('photos', 'renter')->findByPk($id);
	if ($rent) {
	    $formphoto = New imageForm();

		if (isset($_POST['dropimage'])) {  //если был запрос на удаление картинки
		    $this->dropimage($rent, $formphoto);
		} else {
		    if (isset($_POST['imageForm'])) { //если был запрос на добавление изображения
			$this->addImage($rent, $formphoto);
			$rent->with('photos', 'renter')->refresh();
		    }
                    
                    
		    $this->assignAndRender('photosEdit', array('rent' => $rent, 'newphoto' => $formphoto,'model'=>$model));
		}
             
             
	} else
	    throw new CHttpException(404, 'page not found');
    }
    }
    /**
     * Удаление изображения
     * @param Rent $rent 
     */
    private function dropimage($rent, $formphoto) {
	if (preg_match('/^\d+$/', $_POST['imageid']))
	    $image = Photo::model()->findByPk($_POST['imageid']);
	if ($image) {
	    if ($image->rent = $rent->id) {
		ImageProcessing::image()->dropImage($image->file, Yii::app()->params['RENTPHOTOSDIR'] . $rent->id . '/');
		$image->delete();
		Yii::app()->user->setFlash('success', Yii::t('default', 'flash.image.deleted'));
	    }
	}
	$rent->refresh();
	$this->renderPartial('_photosEdit', array('rent' => $rent, 'newphoto' => $formphoto));
    }

    /**
     * Добавление изображения
     * @param type $rent 
     */
    private function addImage($rent, $formphoto) {
	$formphoto->attributes = $_POST['imageForm'];
	if ($formphoto->validate()) {
	    $newPhoto = new Photo();
	    $newPhoto->rent = $rent->id;
	    $file = CUploadedFile::getInstance($formphoto, 'file');
	    if ($file) {
		$filename = CustomFunctions::translit($file->getName());
		$filename = ImageProcessing::image()
			->saveImage($file, $filename, 
				array(
                                    'watermark' => true, 
                                    'watermark_pic' => Yii::getPathOfAlias('webroot').'/'.Yii::app()->params['watermark']['image'],
                                    'watermark_x' => Yii::app()->params['watermark']['x'],
                                    'watermark_y' => Yii::app()->params['watermark']['y'],
                                    'watermark_corner' => Yii::app()->params['watermark']['corner'],
                                    
				    'width' => 650, 
				    'height' => 450, 
				    'maindir' => Yii::app()->params['RENTPHOTOSDIR'] . $rent->id . '/',
				    'thumb'=>array(array(
					'height'=>105,
					'resizeMinimal' => true,
					'width' => 135,
				    ))));
		if ($filename) {
		    $newPhoto->file = $filename;
		    if ($newPhoto->validate()) {
			$newPhoto->save();
			Yii::app()->user->setFlash('success', Yii::t('default', 'flash.image.uploaded'));
			$this->refresh ();
		    }
		    else
			Yii::app()->user->setFlash('error', Yii::t('default', 'flash.image.error.uploading'));
		}
		else
		    Yii::app()->user->setFlash('error', Yii::t('default', 'flash.image.error.uploading'));
	    }
	}
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
                    'jquery.fancybox.css',
	    'cusel.css'
		), array(
	    'menu.js',
	    'jquery.tipTip.js',
	    'jquery.jscrollpane.min.js',
	    'jScrollPaneSelect.js',
	    'jquery-ui-1.8.16.custom.min.js',
	    'somefunctions.js',
	    'jquery.imagetick.js',
	    'edit.js',
	    'cusel.js',
	    'charCount.js',
		    'jquery.fancybox.js',
                    'upScript.js' //скрипт для апов
		)
	);
	$this->render($view, $params);
    }
}