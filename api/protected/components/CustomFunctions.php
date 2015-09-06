<?php

class CustomFunctions {

    //генератор случайного пароля
    static function mkpasswd($length = 8) {
	$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
	$numChars = strlen($chars);
	$string = '';
	for ($i = 0; $i < $length; $i++) {
	    $string .= substr($chars, rand(1, $numChars) - 1, 1);
	}
	return $string;
    }
    //преобразование массива данных
    static function recursiveValuesToType($arrayofValues, $type = 'integer') {
	if (is_array($arrayofValues))
	    foreach ($arrayofValues as &$value)
		self::recursiveValuesToType($value, $type);
	else
	    settype($arrayofValues, $type);
	return $arrayofValues;
    }

    //это хак для серверов, которые не понимают стандартного .htaccess
    static function requestURIToGet() {
	$request = $_SERVER['REQUEST_URI'];
	preg_match_all('/[\?&]([-\da-z]+)=?([^\?&]*)/i', $request, $matches);
	unset($matches[0]);
	foreach ($matches[1] as $key => $value) {
	    $_GET[$value] = $matches[2][$key];
	}
    }

    //замена перевода строк на <br />
    static function slashNtoBR($subject) {
	$replaced = preg_replace("/\r\n|\r|\n/", '<br />', $subject);
	return $replaced;
    }

    //транслит
    static function translit($name = '') {
	$replaced = array('а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', ' ');
	$replacer = array('a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'shj', '', 'i', 'j', 'e', 'yu', 'ya', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'shj', '', 'i', 'j', 'e', 'yu', 'ya', '_');
	$result = str_replace($replaced, $replacer, $name);
	return $result;
    }
    static function gen($var) {
        $var = intval($var);
        $gen = "";
        for ($i = 0; $i < $var; $i++) {
            $te = mt_rand(48, 122);
            if (($te > 57 && $te < 65) || ($te > 90 && $te < 97))
                $te = $te - 9;
            $gen .= chr($te);
        }
        return $gen;
    }
    
    static function ArrayToText($varArray,$shift = ''){
	$result = '';
	foreach ($varArray as $key=>$value){
	    if(!is_array($value)){
		$result.= $shift . $key .' : ' . $value . "\n";
	    }else{
		$result.= $shift. $key." : \n". $this->arrayToText($value, ' '.$key.'.');
	    }
	}
	return $result;
    }
    
    static function urlToParam($url){
	return str_replace('/', '-MS-', $url);
    }
    static function paramToUrl($param){
	return str_replace('-MS-','/', $param);
    }
    
    /**
     * выборка из "закольцованного" массива
     * @param mixed $varsArray
     * @param integer $offset
     * @param integer $limit 
     */
    static function RoundedArraySlise($varsArray,$offset,$limit){
	return array_slice(array_merge($varsArray, array_slice($varsArray, 0, $limit)), $offset, $limit);
    }
    
     /**
     * сдвиг маркера в кольце
     * @param integer $marker
     * @param integer $step
     * @param integer $maxvalue
     * @return integer 
     */
    static function shiftMarker($marker,$step,$maxvalue){
	if ($maxvalue > $step) {
	    $marker += $step;
	    if ($marker >= $maxvalue)
		$marker -=$maxvalue;
	}
	return $marker;
    } 
}

