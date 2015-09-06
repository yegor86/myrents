<?php
Yii::import('application.controllers.AdminController');
/**
 *класс для поля формы загрузки 
 */
class SingleFileUploader extends CFormModel {
    public $mailfile;
    public function rules(){
        return array(
            array('mailfile', 'file'),
        );
    }
}


class AdminMailerController extends AdminController {

    
    public function actionMailer(){
	$dir = Yii::getPathOfAlias('webroot').Yii::app()->params['TEMPDIR'];
	if(!is_dir($dir)) mkdir ($dir);
	$filename = $dir.Yii::app()->params['MAILERFILENAME'];
	$file_exists = is_file($filename);
	$uploadForm = new SingleFileUploader();
	$jobProgress = $this->progress;
	$jobStatus = $this->status;

	
	//если был загружен новый файл
	if(isset($_POST['SingleFileUploader'])){
	    $uploadForm->attributes = $_POST['SingleFileUploader'];
	    $file = CUploadedFile::getInstance($uploadForm, 'mailfile');
	    $file->saveAs($filename);
	    $file_exists=true;
	}

	//если файл существует и есть запрос на старт рассылки, ставим флаг "очередь"
	//демон обнаружит флаг и начнёт рассылу
	if($file_exists&&isset( $_POST['send'])){
	      $jobStatus= $this->status = 'queue';
	      $jobProgress = $this->progress = '0\0';
	    
	}elseif(isset($_POST['decline'])){
	    $jobStatus= $this->status = 'stopping';
	    $jobProgress = $this->progress = 'stopping';
	}
	$params = array(
	    'file_exists'=>$file_exists,
	    'model'=>$uploadForm,
	    'status'=>$jobStatus,
	    'progress'=>$jobProgress
	);
	$this->assignAndRender('mailer',$params);
    }
    
        public function getStatus(){
		$jobStatus = Yii::app()->db->createCommand()
		->select('value')
		->from('DBVariables')
		->where('name = :param',array(':param'=>'DJobStatus'))->queryRow();
		return $jobStatus['value'];
    }
            public function getProgress(){
		$jobStatus = Yii::app()->db->createCommand()
		->select('value')
		->from('DBVariables')
		->where('name = :param',array(':param'=>'DJobProgress'))->queryRow();
		return $jobStatus['value'];
    }
    
    public function setStatus($status){
		    $DBcommand = Yii::app()->db->createCommand()
		    ->update('DBVariables', array('value'=>$status), 'name="DJobStatus"');
    }
    
    public function setProgress($progress){
		    $DBcommand = Yii::app()->db->createCommand()
		    ->update('DBVariables', array('value'=>$progress), 'name="DJobProgress"');
    }
}