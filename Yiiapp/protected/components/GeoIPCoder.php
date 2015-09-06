<?php
//определитель страны и локали по адресу

class GeoIPCoder {
    private $_ip = false;
    private $_code=false;
    private $_locale=false;
    
    static public function init($ip=false){
	$bet = new GeoIPCoder();
	$setIp = ($ip)?$ip:$_SERVER['REMOTE_ADDR'];
	$bet->setIp($setIp);
	return $bet;
	
    }
    
    public function setIp($ip){
	$this->ip=$ip;
	$this->_code = self::getCountryByIp($this->ip);
	$this->_locale = self::localeFromCountryCode($this->_code);
	return $this;
    }
    
    public function getIp(){
	return $this->ip;
    }
    
    public function getCode(){
	return $this->_code;
    }
    
    public function getLocale(){
	return $this->_locale;
    }
    
    static public function getCountryByIp($ipAddress) {
	//$ipDetail = array();
	$result = false;
        $f = false;

	$f = @file_get_contents("http://api.hostip.info/?ip=" . $ipAddress);
/*	//Получаем название города
	if(preg_match("@<Hostip>(\s)*<gml:name>(.*?)</gml:name>@si", $f, $city))
	$ipDetail['city'] = $city[2];
	//Получаем название страны
	if(preg_match("@<countryName>(.*?)</countryName>@si", $f, $country))
	$ipDetail['country'] = $country[1];
*/
	//Получаем код страны
	if($f && preg_match("@<countryAbbrev>(.*?)</countryAbbrev>@si", $f, $countryCode)){
	//$ipDetail['countryCode'] = $countryCode[1];
	    $result = $countryCode[1];
	}

	return $result;
    }
    
    static public function localeFromCountryCode($country_code){
	$codes = Yii::app()->params['default_ru_localization_counrty_codes'];
	if(in_array($country_code,$codes)||$country_code=='XX') return 'ru';
	else	    return 'en';
    }
    

}