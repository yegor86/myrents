<?php

/**
 * класс для работы с загружаемыми онлайн файлами, имеет тот-же интерфейс что и CUploadedFile 
 * реализованы функции, на данныймомент необходимые для работы
 */
class FileFromUrl {

    private $file = false;
    private $filename = false;
    private $lastname = false;

    public function __construct($url = false) {
	if ($url) {
	    $this->filename =  $this->downloadFile($url,array(  'followLocation' => true,
  'maxRedirs' => 5));
	    $params = getimagesize($this->filename);
	    $this->lastname = uniqid();
	    switch($params['mime']){
		case 'image/jpeg':$this->lastname = $this->lastname.'.jpg';break;
		case 'image/gif':$this->lastname = $this->lastname.'.gif';break;
		case 'image/png':$this->lastname = $this->lastname.'.png';break;
	    }
	    $this->file = file_get_contents($this->filename);
	}
    }

    //чистим за собой файло - удаляем временный файл
    public function __destruct() {
	//if (is_file(unlink(Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] . 'tmpdir/' . $this->filename)))
	//    unlink(Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] . 'tmpdir/' . $this->filename);
    }

    public function download($url) {
	    $this->filename =  $this->downloadFile($url,array(  'followLocation' => true, 'maxRedirs' => 5));
	     $params = getimagesize($tmp);
	     $this->lastname = uniqid();
	     switch($params['mime']){
		case 'image/jpeg':$this->lastname = $this->lastname.'.jpg';break;
		case 'image/gif':$this->lastname = $this->lastname.'.jpg';break;
		case 'image/png':$this->lastname = $this->lastname.'.png';break;
	    }
	 $this->file = file_get_contents($this->filename);
	return $this;
    }

    public function saveAs($filename) {
	file_put_contents($filename, $this->file);
	return $this;
    }

    public function getTempName() {
	return $this->filename;
    }

    public function getName() {
	return $this->lastname;
    }

    
    
      /**
   * Downloads a file from a url and returns the temporary file path.
   * @param string $url
   * @return string The file path
   */
  public function downloadFile($url, $options = array())
  {
    if (!is_array($options))
      $options = array();
    $options = array_merge(array(
        'connectionTimeout' => 5, // seconds
        'timeout' => 10, // seconds
        'sslVerifyPeer' => false,
        'followLocation' => false, // if true, limit recursive redirection by
        'maxRedirs' => 1, // setting value for "maxRedirs"
        ), $options);

    // create a temporary file (we are assuming that we can write to the system's temporary directory)
    $tempFileName = tempnam(sys_get_temp_dir(), '');
    $fh = fopen($tempFileName, 'w');

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_FILE, $fh);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $options['connectionTimeout']);
    curl_setopt($curl, CURLOPT_TIMEOUT, $options['timeout']);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $options['sslVerifyPeer']);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, $options['followLocation']);
    curl_setopt($curl, CURLOPT_MAXREDIRS, $options['maxRedirs']);
    curl_exec($curl);

    curl_close($curl);
    fclose($fh);

    return $tempFileName;
  }
    
    
}

