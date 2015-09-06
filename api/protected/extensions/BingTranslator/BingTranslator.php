<?php

Yii::import('application.extensions.BingTranslator.AccessTokenAuth');

class BingTranslator extends CApplicationComponent {

    public $microsoft_client_id;
    public $microsoft_client_name;
    public $microsoft_client_secret;
    public $microsoft_scope;
    public $microsoft_grant_type;
    public $microsoft_auth_url;
    private $_auth_header = false;

    const TranslateMethodUrl = 'http://api.microsofttranslator.com/V2/Http.svc/Translate';
    const DetectMethodUrl = 'http://api.microsofttranslator.com/V2/Http.svc/Detect';

    public function init() {
	parent::init();
    }

    public function getAuthHeader() {
	if (!$this->_auth_header) {
	    $authToken = new AccessTokenAuth();
	    $this->_auth_header = "Authorization: Bearer " . $authToken->getTokens(
			    $this->microsoft_grant_type, $this->microsoft_scope, $this->microsoft_client_id, $this->microsoft_client_secret, $this->microsoft_auth_url);
	}
	return $this->_auth_header;
    }

    /*
     * Create and execute the HTTP CURL request.
     * @param string $url        HTTP Url.
     * @param string $authHeader Authorization Header string.
     * @param string $postData   Data to post.
     * @return string.
     *
     */

    function curlRequest($url, $postData = '') {
	$authHeader = $this->authHeader;
	//Initialize the Curl Session.
	$ch = curl_init();
	//Set the Curl url.
	curl_setopt($ch, CURLOPT_URL, $url);
	//Set the HTTP HEADER Fields.
	curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader, "Content-Type: text/xml"));
	//CURLOPT_RETURNTRANSFER- TRUE to return the transfer as a string of the return value of curl_exec().
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	//CURLOPT_SSL_VERIFYPEER- Set FALSE to stop cURL from verifying the peer's certificate.
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, False);
	if ($postData) {
	    //Set HTTP POST Request.
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    //Set data to POST in HTTP "POST" Operation.
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	}
	//Execute the  cURL session.
	$curlResponse = curl_exec($ch);
	//Get the Error Code returned by Curl.
	$curlErrno = curl_errno($ch);
	if ($curlErrno) {
	    $curlError = curl_error($ch);
	    throw new Exception($curlError);
	}
	//Close a cURL session.
	curl_close($ch);
	return $curlResponse;
    }

    /*
     * Create Request XML Format.
     * @param string $languageCode  Language code
     * @return string.
     */

    function createReqXML($languageCode) {
	//Create the Request XML.
	$requestXml = '<ArrayOfstring xmlns="http://schemas.microsoft.com/2003/10/Serialization/Arrays" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">';
	if ($languageCode) {
	    $requestXml .= "<string>$languageCode</string>";
	} else {
	    throw new Exception('Language Code is empty.');
	}
	$requestXml .= '</ArrayOfstring>';
	return $requestXml;
    }

    public function detect($inputStr) {
	$languageCode = false;
	$detectMethodUrl = self::DetectMethodUrl . "?text=" . urlencode($inputStr);
	$strResponse = $this->curlRequest($detectMethodUrl);
	$xmlObj = simplexml_load_string($strResponse);
	foreach ((array) $xmlObj[0] as $val) {
	    $languageCode = $val;
	}
	return $languageCode;
    }

    public function translate($inputStr, $from = 'ru', $to = 'en', $maxTranslation = 1) {
	$uri = null;
	$contentType = "text/plain";
	$params = "?from=$from"
		. "&to=$to"
		. "&maxTranslations=$maxTranslation"
		. "&contentType=$contentType"
		. "&text=" . urlencode($inputStr);
	$getTranslationUrl = self::TranslateMethodUrl . $params;
	$curlResponse = $this->curlRequest($getTranslationUrl);
	$xmlObj = simplexml_load_string($curlResponse);
	return (string)$xmlObj;
    }

}