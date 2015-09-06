<?php
/**
 * перевод массива в нижний регистр
 * @param type $string 
 */
 function mb_lower(&$string){
    $string = mb_strtolower($string,'UTF-8');
 }


//show profiler
defined('YII_DEBUG_SHOW_PROFILER') or define('YII_DEBUG_SHOW_PROFILER',true);
//enable profiling
defined('YII_DEBUG_PROFILING') or define('YII_DEBUG_PROFILING',true);


/*
 * Обработчик запроса на выдачу короткого имени
 * не требует загрузки всего движка Yii
 * по-этому был выложен в отдельный файл
 */

/*
 * установка таймзоны, подгрузка конфигурации, подключение дополнительных классов
 */
date_default_timezone_set('Europe/Kiev');
$dirname = dirname(__FILE__);
$config = require_once $dirname . '/protected/config/main.php';
require_once $dirname . '/short_name/database.php';
require_once $dirname . '/protected/extensions/Text_LanguageDetect/Text/LanguageDetect.php';
// Include the sphinx API class
require_once $dirname . '/short_name/sphinxapi.php';

//класс определения языка
$l = new LanguageDetect();

//connect to DB
$db = new DataBase($config);
// Connect to sphinx server
$sp = new SphinxClient();
 
// Set the server
$sp->SetServer('localhost', 9312);
//$sp->SetServer('192.168.0.50', 9312);
$sp->SetMatchMode(SPH_MATCH_ALL);
$sp->SetSortMode(SPH_SORT_ATTR_ASC, 'level');
$sp->SetArrayResult(true);
$sp->SetLimits(0, 5);

//$resultArray содержит массив, который вернётся клиенту
$resultArray = array();
//
// обьявления и подготовка завершена, дальше тело программы
//

$string =trim($_POST['search']);  //получачаем строку поиска
$detected = 'ru'; //по умолчанию  считаем язык русским
try {
     $l->omitLanguages(array('english','russian'),true); //устанавливаем искомые языки, чтобы лишние не попадали в выборку
     $l->setNameMode(2);		             //мод отображения - двубуквенный
    $result = $l->detect($string);			//определяем язык
    if(count($result)) $detected = array_shift(array_keys($result));
} catch (Text_LanguageDetect_Exception $e) {
    $detected = 'ru';   //в случае ошибки просто продолжаем работу
}

$regexp_matches=array();
preg_match_all('/([-a-zа-я\d]+)/iu', $string,$regexp_matches); //разбиваем на слова
$string = '*' . implode('*, *', $regexp_matches[1]) . '*'; //добавляем звёздочки после слов
unset ($regexp_matches[0]); //избавляемся от уже ненужного массива


$sphinx_query = $string;
//$sphinx_query = ($detected=='ru')?"@fullname $string":"@fullname_en $string";

//поиск в  сфинксе
$sphinxresult= $sp->Query($sphinx_query, 'adresses');
//выбор найденных адресов из базы, 
$resultArray['adresses'] =  $db->getFullTextNames($sphinxresult,$detected);


//если нужны регионы
if(isset($_POST['neededregions'])&&$_POST['neededregions']){ 

    $regions=array();
    $cityes = $db->getCityes($detected);
    //опускаем все элементы в нижний регистр, 
    array_walk($regexp_matches[1],'mb_lower');

    //вычисляем схождение: есть ли в словах поиска название города
    $queryCityes = array_intersect (array_keys($cityes),$regexp_matches[1]);

    //если схождения были найдены, берём первое из схождения
    //и ищем по нему наследников
    if(count($queryCityes)) $regions=$db->getChilds($cityes[reset($queryCityes)],$detected);
    $resultArray['regions'] = $regions;
}

//вывод результата в JSON
echo json_encode($resultArray);



