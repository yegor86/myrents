<?php
Class ImageProcessing extends CImageHandler{
    

    
    static function image(){
	$image = new ImageProcessing;
	return $image;
    }
    
    //удаление картинки и её превью
    public function dropImage($filename, $dir = '', $thumb = '') {
	$rmdir = ($dir) ? Yii::getPathOfAlias('webroot') . $dir : Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'];
	if ($thumb)
	    $tdir = Yii::getPathOfAlias('webroot') . $thumb;
	elseif ($dir)
	    $tdir = Yii::getPathOfAlias('webroot') . $dir . Yii::app()->params['THUMBDIR'];
	else
	    $tdir = $rmdir . Yii::app()->params['THUMBDIR'];
	if (is_file($rmdir . '/' . $filename))
	    unlink($rmdir . $filename);
	if (is_file($tdir . '/' . $filename))
	    unlink($tdir . $filename);
    }

    //генератор имени файла
    public function newfilename($dir = '', $filename = '', $concat = false) {
	if ($concat === false)
	    $concat = 0;
	$concatstring = 'qwertyuiopasdfghjklzxcvbnm0123456789';
	$return = $concatstring[$concat] . $filename;
	if (is_file($dir . $return)) {
	    if ($concat >= 35) {
		$filename = '_' . $filename;
		$concat = -1;
	    }
	    $return = self::newfilename($dir, $filename, ++$concat);
	}
	return $return;
    }

    //сохранятор изображений и превью
    public function saveImage($file, $filename, $imageParams = array()) {
	//saving file
	$param = getimagesize($file->getTempName());
	if ($param) {
	    if ($param[0] < Yii::app()->params['maximagesize']['width'] && $param[1] < Yii::app()->params['maximagesize']['height']) {
		$dir = (isset($imageParams['maindir'])) ? Yii::getPathOfAlias('webroot') . $imageParams['maindir'] : Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'];
		if (is_file($dir . $filename)) {
		    $overwrite = false;
		    if (isset($imageParams['overwrite'])) {
			if ($imageParams['overwrite']) {
			    $overwrite = true;
			}
		    }
		    if ($overwrite) {
			unlink($dir . $filename);
		    }
		    else
			$filename = self::newfilename($dir, $filename);
		}
		if (!is_dir($dir))
		    mkdir($dir);
		$file->saveAs($dir . $filename, true);
		$width = (isset($imageParams['width'])) ? ($imageParams['width']) : false;
		$height = (isset($imageParams['height'])) ? ($imageParams['height']) : false;
		//twidth thumbnail width, theight thumbnail
		$twidth = (isset($imageParams['twidth'])) ? ($imageParams['twidth']) : false;
		
		
		//ресайзинг изображения
		if($width||$height){
		    if($width) $width = ($width<$param[0])?$width:$param[0];
		    if ($height) $height = ($height<$param[1])?$height:$param[1];
		    if (isset($imageParams['resizeMinimal'])&&($imageParams['resizeMinimal'])){
			if (($param[0]>$param[1])&&($height)) $width = false;
			elseif (($param[1]>$param[0])&&($width)) $height = false;
		    }
		                            //сохранение изображения
		    if (isset($imageParams['watermark'])){
                        $this->load($dir . $filename)
                            ->resize($width, $height)
                            ->watermark($imageParams['watermark_pic'], $imageParams['watermark_x'], $imageParams['watermark_y'], $imageParams['watermark_corner'])
                            ->save(false, false, 90, false);
                    }else{
                        $this->load($dir . $filename)
                            ->resize($width, $height)
                            ->save(false, false, 90, false);
                        
                    }
		}else {
                    $this->load($dir . $filename)->save(false, false, 90, false);
                }
		
		//получение параметров о превьюшке		
		if(isset($imageParams['thumb'])&&  is_array($imageParams['thumb'])){
		    
		    foreach ($imageParams['thumb'] as $thumbParams){
		    
		$theight = (isset($thumbParams['height'])) ? ($thumbParams['height']) : false;
		$twidth = (isset($thumbParams['width'])) ? ($thumbParams['width']) : false;
		$tpath = (isset($thumbParams['path'])) ? $dir .  $thumbParams['path'] : $dir . Yii::app()->params['THUMBDIR'];
		//если указан азмер превьюшки - делаем её
		if ($twidth || $theight) {
		    if($twidth) $twidth = ($twidth<$param[0])?$twidth:$param[0];
		    if ($theight) $theight = ($theight<$param[1])?$theight:$param[1];
		    if (isset($thumbParams['resizeMinimal'])&&($thumbParams['resizeMinimal'])){
			if (($param[0]>$param[1])&&($theight)) $twidth = false;
			elseif (($param[1]>$param[0])&&($twidth)) $theight = false;
		    }
		    if (is_file($tpath . $filename))
			unlink($tpath . $filename);
		    if (!is_dir($tpath))
			mkdir($tpath);
		    $this->load($dir . $filename)
			->thumb($twidth, $theight)
			->save($tpath . $filename);
		}
		
		
		
		    }
		}
		 
		
		
		Yii::app()->user->setFlash('success', Yii::t('default', 'Изображение сохранено'));  
		return $filename;
	    } else { 
		Yii::app()->user->setFlash('error', Yii::t('default', 'Изображение превышает допустимые размеры'));  
		return false;
	    }
	} else  {Yii::app()->user->setFlash('error', Yii::t('default', 'неверный формат файла'));  
	    return false;}
    }


    
    
}

?>
