<?php
Yii::import('application.controllers.MyRentsController');
class SEOController extends MyRentsController{
    
    
    /**
     * Сайтмап для сео индексный файл,
     * @param type $map 
     */
    public function  actionSitemapIndex(){
	$sitemapArray = array();
	//не указан конкретный файл - создам индексный
	    $sitemapArray[]='/sitemap_static.xml'; //подключаем файл со статичными ссылками
	    //подключаем файлы пользователей
	    $user_count = User::model()->count(); //считаем общее количество пользователей
	    $this->addlIndexLinks($sitemapArray,'/sitemap_users',$user_count); //странички самих пользователей
	    $this->addlIndexLinks($sitemapArray,'/sitemap_userhostings',$user_count); //странички аренд пользователей
	    //подключаем файлы аренд, аренды считаются только активные с указанными ценами и адресами
	    $criteria = new CDbCriteria;
	    $criteria->condition = 
		    '`in_show` = 1
		    AND	(CASE  `current_price` 
			WHEN 1 THEN `price_day`
			WHEN 2 THEN `price_week`
			WHEN 3 THEN `price_month`
			END) ' . '>= 1';
	    $criteria->with = array(
		'adress'=>array('joinType' => 'INNER JOIN')
	    );
	    $rents_count = Rent::model()->count($criteria);
	    $this->addlIndexLinks($sitemapArray,'/sitemap_rents',$rents_count); //странички самих пользователей
	    // TODO: загнать массив в ХМЛ
	    
	    header('Content-type: application/xml');
	$converter = new Array2XML();
	$converter->setRootName('urlset');
	$xmlStr = $converter->convert($sitemapArray,'url');
	echo ($xmlStr);
    }
    
    
    /**
     * не индексный файл (список рабочих ссылок)
     * @param type $type тип файла (статичнй, пользователи, аренды)
     * @param type $count  (счёт - для ограничения в 50к)
     */
    public function actionSitemapLinks($type,$count=0){
	if($count)$count--;
	$linksArray = array();
	//создание ссылок
	switch ($type){
	    
	    //ссылки из статичного массива
	    case 'static': $linksArray=Yii::app()->params['SEOStaticSitemapLinks'];break;
	    //ссылки пользователей
	    case 'users': $linksArray = $this->getModelsLinks('/user/{id}','User',$count,false,0.8,'last_worked');break;
	    //ссылки на страницы аренд пользователей
	    case 'userhostings': $linksArray = $this->getModelsLinks('/user/{id}/hostings','User',$count,false,0.8,'last_worked');break;
	    //ссылки на аренды, выбираются только активные заполненные аренды
	    case 'rents':
		$criteria = new CDbCriteria;
		$criteria->condition =
			'`in_show` = 1
			AND (CASE  `current_price` 
			WHEN 1 THEN `price_day`
			WHEN 2 THEN `price_week`
			WHEN 3 THEN `price_month`
			END) ' . '>= 1';
		$criteria->with = array(
		    'adress' => array('joinType' => 'INNER JOIN')
		);
		$linksArray = $this->getModelsLinks('/rent/{id}','Rent',$count,$criteria,0.8,'last_up');break;
	}
	// TODO: загнать массив в ХМЛ
	header('Content-type: application/xml');
	$converter = new Array2XML();
	$converter->setRootName('urlset');
	$xmlStr = $converter->convert($linksArray,'url');
	echo ($xmlStr);
    }
    
    /**
     * создание массива ссылок из моделей, сласс модели указывается в параметре
     * @param type $linkTemplate		шаблон сылки
     * @param type $class		класс модели
     * @param type $count		страница счёта
     * @param CDbCriteria $criteria	условия выборки
     * @return array(string)		возврат - массив ссылок
     */
    private function getModelsLinks($linkTemplate,$class,$count=0,$criteria = false,$priority=0.80,$daterow = false){
	$result = array();
	$linkTemplate = 'http://' . Yii::app()->request->serverName . $linkTemplate;
	$max_links_count = Yii::app()->params['sitemap_max_links'];
	if(!$criteria) $criteria = new CDbCriteria;
	$criteria->offset = $count*$max_links_count;
	$criteria->limit = $max_links_count;
	$elements = $class::model()->findAll($criteria);
	foreach ($elements as $element){
	    $elem = array();
	    $elem['loc']=preg_replace('/\{id\}/', $element->id, $linkTemplate);
	    $elem['lastmod']=($daterow)?$element->$daterow:date("Y-m-d H:i:s");
	    $elem['priority']=$priority;
	    $elem['hangefreq']='daily';
	    $result[] = $elem;
	}
	return $result;
    }
    
    /**
     * создание подсчётных ссылок
     * @param type $linksArray массив, куда сохранятся ссылки на индекс
     * @param type $linkPrefix  префикс для ссылок файлов
     * @param type $countOfItems общее количество вложеных ссылок
     */
    private function addlIndexLinks(&$linksArray,$linkPrefix,$countOfItems){
		$linkPrefix = 'http://' . Yii::app()->request->serverName . $linkPrefix;
	$max_links_count = Yii::app()->params['sitemap_max_links'];
	$count = (int)(($countOfItems+1)/$max_links_count);
	// тут заменить на нормальное округление в большую сторону
	if($countOfItems%$max_links_count)$count++;
	//
	for ($i = 1; $i<=$count; $i++){
	    $linksArray[] =$linkPrefix . $i . '.xml'; 
	}
    }
    
    
}