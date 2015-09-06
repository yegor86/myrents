<?php

/**
 * VKAPI class for vk.com social network
 *
 * @package server API methods
 * @link http://vk.com/developers.php
 * @autor Oleg Illarionov
 * @version 1.0
 */
 
class vkapi {
	var $api_secret;
	var $app_id;
	var $api_url;
	
	function vkapi($app_id, $api_secret, $api_url = 'https://api.vk.com') {
		$this->app_id = $app_id;
		$this->api_secret = $api_secret;
		if (!strstr($api_url, 'https://')) $api_url = 'https://'.$api_url;
		$this->api_url = $api_url;
	}
	
	function api($method,$params=false) {
		if (!$params) $params = array(); 
		$access_token = $this->getAccessToken();
		$params['api_id'] = $this->app_id;
	    $params['client_secret']=$this->api_secret;
		$params['v'] = '3.0';
		//$params['method'] = $method;
		$params['timestamp'] = time();
		$params['format'] = 'json';
		$params['random'] = rand(0,10000);
		ksort($params);
		$sig = '';
		foreach($params as $k=>$v) {
			$sig .= $k.'='.$v;
		}
		$sig .= $this->api_secret;
		$params['sig'] = md5($sig);
		$params=$this->params($params);
		$query = $this->api_url.'/method/'.$method.'?access_token='.$access_token.'&'.$params;
		$postvars = array();//$this->params($params);
		$res = $this->execQuery($query, $postvars);
		return json_decode($res, true);
	}
	
	function params($params) {
		$pice = array();
		foreach($params as $k=>$v) {
			$pice[] = $k.'='.urlencode($v);
		}
		return implode('&',$pice);
	}
	
	private function getAccessToken(){
	    $param['client_id']=$this->app_id;
	    $param['client_secret']=$this->api_secret;
	    $param['grant_type']='client_credentials';
	    $params = $this->params($param);
	    $res = json_decode($this->execQuery('https://oauth.vk.com/access_token', $params),true);
	    return $res['access_token'];
	}
	
	private function execQuery($query,$postvars=''){
	    $chp = curl_init($query);
		curl_setopt($chp, CURLOPT_HEADER,0);
		curl_setopt($chp, CURLOPT_RETURNTRANSFER ,1);
		curl_setopt($chp, CURLOPT_POST, 3);
		curl_setopt($chp, CURLOPT_POSTFIELDS, $postvars);
		$res = curl_exec($chp);
		curl_close($chp);
		return $res;
	}
}
?>
