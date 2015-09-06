<?php

/**
 * Базовый класс для наследования всеми остальными 
 */
class MyRentsController extends CController {

        public function filters() {
	return array(
	    'accessControl'
	);
    }
    public function accessRules() {
	return array(
	    array('allow',
		'users' => array('?'),
		'message' => 'Access Denied.',
	    ),
	);
    }
    
    protected $_assetsUrl = false;
    protected $_currencies = false;      //список валют
    protected $_currentCurrency = false;     //текущая валюта
    protected $_langs = false;      //список языков
    protected $_curlang = false;      //текущий язык
    protected $_user = false;      //текущий пользователь (если авторизирован)

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();


    /**
     * подключаем экшн капчи, в корневой класс 
     * @return type 
     */
    public function actions() {
	return array(
	    'captcha' => array(
		'class' => 'CCaptchaAction',
		'backColor' => 0xFFFFFF,
		'testLimit' => 1,
		'height' => 35,
	    ),
	);
    }

    public function init() {
	$this->setUserInfo();
	$this->rememberLink();
	$this->registerAssets();
	$this->updateUserLastWorked();
	$this->setLang();
	$this->setCurrency();
        if(isset($this->user->role)=='admin' || isset($this->user->role)=='moderator'){
            $this->countComments();
            $this->countRents();
        }
    }

    
    //запоминаем запрос страницы, страница логина не запоминает
    public function rememberLink(){
	if(!Yii::app()->request->isAjaxRequest &&(in_array($this->uniqueId,Yii::app()->params['controllersToRedirect'])))
	{
	    Yii::app()->user->returnUrl = Yii::app()->request->requestUri;
	}
    }

    public function getAssetsUrl() {
	return $this->_assetsUrl;
    }
    
    public function countComments() {
        $today = date('Y-m-d H:i:s');
        $criteria = new CDbCriteria();
        $criteria->condition = '`t`.`date` between "'.date("Y-m-d H:i:s",strtotime($today)-86400).'" AND "'.$today.'"';
        $comments = RentComment::model()->findAll($criteria);
        return (count($comments)) ? "(".count($comments).")" :'' ;
    }
    public function countRents() {
        $today = date('Y-m-d H:i:s');
        $criteria = new CDbCriteria();
        $criteria->condition = '`t`.`creation_date` between "'.date("Y-m-d H:i:s",strtotime($today)-86400).'" AND "'.$today.'"';
        $rents = Rent::model()->findAll($criteria);
        return (count($rents)) ? "(".count($rents).")" :'' ;
    }
    public function getCurrencies() {
	return $this->_currencies;
    }

    public function getCurrentCurrency() {
	return $this->_currentCurrency;
    }

    public function getLangs() {
	return $this->_langs;
    }

    public function getCurlang() {
	return $this->_curlang;
    }

    public function getUser() {
	return $this->_user;
    }

    static function resetUser($user) {
	$this->_user = $user;
    }

    /**
     * добавление параметров и рендер по умолчанию
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params = array()) {
	$StaticSssFiles = array(
	    'style.css',
	    'tipTip.css'
	);
	$StaticJsFiles = array(
	    'menu.js',
	    'jquery.tipTip.js',
	);
        $url = $this->getAssetsUrl;
	$cs = Yii::app()->clientScript;
	$cs->registerCoreScript('jquery');
	foreach ($StaticSssFiles as $cssfile) {
	    $cs->registerCssFile($url . '/css/' . $cssfile);
	}
	foreach ($StaticJsFiles as $jsfile) {
	    $cs->registerScriptFile($url . '/js/' . $jsfile);
	}

	$this->render($view, $params);
    }

/**
 *установка информации о пользователе 
 */
    protected function setUserInfo() {
	if (!Yii::app()->User->isGuest) {
	    $this->_user = User::model()->findByPk(Yii::app()->User->id);
	} 
	if(!$this->_user){
	    $this->_user = new User ();
	    $this->_user->active = false;
	};
	if(isset($this->_user->role))
	    Yii::app()->user->setState('roles', $this->_user->role);
	   else Yii::app()->user->setState('roles', 'reader');
	
    }

    //подключение assets-урл
    private function registerAssets() {
	$assets_path = Yii::getPathOfAlias('application') . Yii::app()->params['assets'];
	$url = Yii::app()->assetManager->publish($assets_path, false, -1, YII_DEBUG);
	$this->_assetsUrl = $url;
    }

    /**
     * подключение яндекс-карты 
     */
    protected function assignYandexMap($MRYaMapScript = false, $position = CClientScript::POS_HEAD) {
	$cs = Yii::app()->clientScript;

	//$cs->registerScriptFile('http://api-maps.yandex.ru/1.1/index.xml?key=' . Yii::app()->params['yandexKey'], $position);
	$cs->registerScriptFile( 'http://api-maps.yandex.ru/2.0/?load=package.full&mode=debug&lang=ru-RU',$position);
	if ($MRYaMapScript !== false)
	    $cs->registerScriptFile($this->assetsUrl . '/js/' . $MRYaMapScript, $position);
    }

    /**
     * подключение цсс и джаваскриптов
     * @param type $cssfiles
     * @param type $jsfiles 
     */
    protected function assignControllerJsCss($cssfiles = array(), $jsfiles = array()) {

	
	$cs = Yii::app()->clientScript;
	$cs->registerCoreScript('jquery');
	$url = $this->assetsUrl;
	foreach ($cssfiles as $cssfile) {
	    $cs->registerCssFile($url . '/css/' . $cssfile);
	}
	foreach ($jsfiles as $jsfile) {
	    $cs->registerScriptFile($url . '/js/' . $jsfile);
	}
    }

    //установка языка
    private function setLang() {
	
	//пришел явный запрос на изменение языка,  сохраняем его в куках
	if (isset($_GET['lang']) && in_array($_GET['lang'], Yii::app()->params['langs'])) { //если есть запрос - устанавливаем язык в куки
	    Yii::app()->request->cookies['lang'] = new CHttpCookie('lang', strtolower($_GET['lang']));
	    Yii::app()->language = $_GET['lang'];
	}
	
	//если есть язык, сохранённый в куках, то устанавливаем его
	if (isset(Yii::app()->request->cookies['lang'])) { 
	    $lang = Yii::app()->request->cookies['lang']->value;
	    if (in_array($lang, Yii::app()->params['langs']))
		Yii::app()->language = $lang;  //если он валидный (мало ли кто там куки правил), то устанавливаем
	}
	
	//если язык не установлен в куках (а, следовательно, и небыло запроса на изменение), определяем по геокоординатам
        //после определения сохраняем (чтобы по 300 раз не запрашивать)
	else{ //если язык всёравно не установлен - определяем по GeoIp
	     
	    //$geoIPCoder = GeoIPCoder::init();
	    $geoIPCoder = GeoIPCoder::init(); //(IP сан-франциско, для проверки)
		$lang = $geoIPCoder->getLocale();
		if($lang) {
	//	     Yii::app()->request->cookies['lang'] = new CHttpCookie('lang', $lang);
		     Yii::app()->language = $lang;
                     Yii::app()->request->cookies['lang'] = new CHttpCookie('lang', $lang);
		}
	}
	$cachetime = Yii::app()->params['cachetime'];
	$this->_langs = Language::model()->cache($cachetime)->findAll();
	$this->_curlang = Language::model()->cache($cachetime)->findByAttributes(array('language' => Yii::app()->language));
    }

    //установка валюты
    private function setCurrency() {
	if (isset(Yii::app()->request->cookies['currency'])) {    //если в куках имеется, то устанавливаем с куки
	    Yii::app()->params['Currency'] = Yii::app()->request->cookies['currency']->value;
	}
	/*закоментировал переключение валюты по-умолчанию от локали
	 * elseif(Yii::app()->language =='en') {
	    Yii::app()->params['Currency'] = 3;
	}*/
	$cachetime = Yii::app()->params['cachetime'];
	$this->_currencies = Currency::model()->cache($cachetime)->findAll();
	$this->_currentCurrency = Currency::model()->cache($cachetime)->findByPk(Yii::app()->params['Currency']);
    }

    //обновление последнего посещения
    private function updateUserLastWorked() {
	if (!Yii::app()->user->isGuest) {
	    User::model()->updateByPk(Yii::app()->User->id, array('last_worked' => date('Y-m-d H:i:s')));
	}
	
    }

    public function actionError() {
	if ($error = Yii::app()->errorHandler->error) {
	    if (Yii::app()->request->isAjaxRequest)
		$this->renderPartial('/errors/ajax_error', $error);
	    else
		if($error['code']==404){
		    $this->assignAndRender('/errors/404_not_found', $error);
		    
		}
		    else
		$this->assignAndRender('/errors/error', $error);
	}
    }

    /**
     *
     * @param array of models $modelsarray - массив моделей
     * @param string $valuekey                      - поле из которого брать индексы
     * @param string $labelkey                       - поле из которого брать значения
     * @return array                                        - возвращаем массив в виде ('индекс'=>'значение', ... 'индексN'=>'значениеN')
     */
    protected function modelsNamestoArray($modelsarray = array(), $valuekey = 'id', $labelkey = 'name', $category = 'default', $localised = true) {
	$result = array();
	if ($localised)
	    foreach ($modelsarray as $model)
		$result[$model->$valuekey] = Yii::t($category, $model->$labelkey);
	else
	    foreach ($modelsarray as $model)
		$result[$model->$valuekey] = $model->$labelkey;
	return $result;
    }

    /**
     * создание кейвордсов из строки
     * @param type $title
     * @return type 
     */
    public function toKeywords($title) {
	$return = '';
	if (is_array($title))
	    $return = implode(", ", $title);
	elseif (is_string($title))
	    $return = preg_replace('/([^-a-zа-я\d])*([-a-zа-я\d]+)(?=\b)/ui', "$2,", $title);

	return $return;
    }

    /**
     * генерация хлебных крошек
     * @param type $searchpage
     * @return type 
     */
    public function BreadCrumbs($searchpage = false) {
       $breadcrumbs = array('links' => array());
	if ($searchpage) {
	    $url = Yii::app()->request->requestUri;
	    $urlpath = explode('/', trim($url, '/'));
	    $curlink = '';
	    $lastkey = count($urlpath) - 1;
	    foreach ($urlpath as $key => $path) {
		$curlink .='/' . $path;
if($path!='search'){
		if ($key != $lastkey)
		    $breadcrumbs['links'][$this->getLinkName($curlink)] = $curlink;
		else
		    $breadcrumbs['links'][] = $this->getLinkName($curlink);
	    }}
	    }
	
	return $breadcrumbs;
    }

    /**
     * получение имени ссылки из пути
     * @param type $pathname
     * @return type 
     */
    public function getLinkName($pathname) {
	$result = Yii::t('SEOlinks', $pathname);
	return $result;
    }

    /**
     * создание ссылки для СЕО
     * @param type $elements
     * @param type $prelink
     * @param type $level
     * @return string 
     */
    private function createSeoLink($elements,$prelink,$level){
	$result=array();
	if($level!=2){
	    foreach ($elements as $key=>$value){
		$result[Yii::t('SEOlinks', $prelink . $key)] = $prelink . $key;
	    }
	}
	else{
	    foreach ($elements as $key=>$value){
		$subelements = Yii::app()->params[Yii::app()->params['seoLinksparam'][3]];
		foreach ($subelements as $skey=>$svalue){
			$result[Yii::t('SEOlinks', $prelink . $key . '/' . $skey)] = $prelink . $key . '/' . $skey;
		}
	    }
	}

	return $result;
    }
    
    /**
     * создание ссылок для сео на страницы предопределённого поиска
     * @param type $level
     * @return type 
     */
    public function createSeoLinks($level = 0) {
	$result = array();
	$selflink =($level)?rtrim(preg_replace( "/(\/[a-z]{2}\/)$/",'/', Yii::app()->request->requestUri), '/').'/':'/search/';
	$result=(isset(Yii::app()->params['seoLinksparam'][$level]))
	?$this->createSeoLink(Yii::app()->params[Yii::app()->params['seoLinksparam'][$level]], $selflink,$level)
	:array();
	return $result;
    }
    
    /**
     * отображение аякс\полная страница
     * @param type $controller
     * @param type $view
     * @param type $params 
     */
    public function show($view,$viewparams=array()){
	    if (Yii::app()->request->isAjaxRequest) {
		$view = (isset($viewparams['view']))?$viewparams['view']:'_'.$view;
		$viewparams = (isset($viewparams['params']))?$viewparams['params']:$viewparams;
		if(isset($viewparams['JSNoReload'])&&$viewparams['JSNoReload']){
		    $this->renderPartial($view, $viewparams);
		}else
		$this->renderPartial($view, $viewparams, false, true);
	    } else
		$this->assignAndRender($view, $viewparams);
    }

}

?>
