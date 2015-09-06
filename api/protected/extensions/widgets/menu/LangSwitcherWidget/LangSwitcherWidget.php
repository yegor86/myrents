<?php

class LangSwitcherWidget extends BaseWidget {
    public function init() {
	    parent::init(__FILE__);
	    $this->addClientCsriptFiles();
	// этот метод будет вызван методом CController::beginWidget()
    }
    public function run() {
    $this->render('langsSwitcher', array('curlang' => $this->controller->curlang, 'langs' => $this->controller->langs));
    }

    
   private function addClientCsriptFiles(){
	$cs = Yii::app()->clientScript;
	$cs->registerScriptFile($this->_assetsUrl . '/js/langsSwitcher.js', CClientScript::POS_HEAD);
	$cs->registerCssFile($this->_assetsUrl.'/css/langsSwitcher.css');

    }
    
    //генерация ссылки на текущий документ с переключенным языком
    public function getUrl($lang='ru'){
	$url=Yii::app()->getRequest()->requestUri; 
	$langsr=Yii::app()->cache->get('langsarray');
	if(!$langsr){
	$langs = Language::model()->findAll();
	    $langsr = array();
	    foreach ($langs as $langg){
		$langsr[] = $langg->language;
	    }
	    $langsr = implode('|', $langsr);
	    Yii::app()->cache->set('langsarray', $langsr, Yii::app()->params['cachetime']);
	}
	$url = rtrim($url,'/');
	$url=preg_replace('/(\/('. $langsr .'))(\/|$)/ui','',$url);//удаляем строку языка из имеющегося запроса (если такая найдётся)
	//print_r($url);die();
//	$url = rtrim(preg_replace('/(\/[a-z]{2}\/)/','', $url),'/'); //если в строке ужеесть выбор языка, то отключаем его
	
	//для страницы поиска перебираем дополнительные приставки, и вставляем перевод
	preg_match('/^(.*?)\?(.*)$/', $url,$matches);
	if($matches){
	$url = rtrim($matches[1],'/') . '/' . $lang .'/';
	if($matches[2])
	    $url .= '?' . $matches[2]; //добавляем приставку языка в урл
	}
	else $url = $url . '/' . $lang .'/';
	return $url;
    }

}

?>
