<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataBase {

    private $db = false;
    private $config = false;

    public function __construct($config = array()) {
	$this->config = $config;
	/**
	 * $var array $dbconf кофигурация базы данных из файла конфигурации
	 */
	$dbconf = $config['components']['db'];
	/**
	 * настройка хранится одной строкой, разбиваем на составные 
	 */
	$dbarr = array();
	preg_match('/^mysql:host=([-\w\.]+)\;dbname=([-\w]+)$/', $dbconf['connectionString'], $dbarr);
	/**
	 * соединение с БД 
	 */
	
	try {
	    if (!$this->db = mysql_connect($dbarr[1], $dbconf['username'], $dbconf['password']))
		throw new Exception('can`t connect to database');
	    elseif (!mysql_select_db($dbarr[2], $this->db))
		throw new Exception('can`t select database');
	    else
		(mysql_query('set names utf8', $this->db));
	} catch (Exception $exc) {
	    echo $exc->getMessage();
	}
    }

    //выполнение запроса и вывод его в массив
    //allresult - флаг, преобразовать одну строку в массив, или преобразовать весь результат в массив полей
    public function dbquerytoarr($query, $allresult = true) {
	$result = array();
	$queryresult = mysql_query($query, $this->db) or die(mysql_error());
	if ($queryresult) {
	    if ($allresult) {
		while ($row = mysql_fetch_array($queryresult)) {
		    $result[] = $row;
		}
	    }else
		$result = mysql_fetch_array($queryresult);
	}
	return $result;
    }

    //выполнение запроса
    public function dbquery($query) {
	if (!$res = mysql_query($query, $this->db))
	    echo("error at query $query    " . mysql_error());
    }

    //получение списка адресов
    function getFullTextNames($matches,$detect='ru') {
	$ids = array();
	$result = array();
	//перелистываем совпадения и получаем их IDшники
	$rowname = ($detect=='ru')?'name':'name_en';
	if ($matches && isset($matches['matches'])) {
	    foreach ($matches['matches'] as $macth) {
		$ids[] = $macth['id'];
	    }


	    $query = "SELECT (SELECT GROUP_CONCAT(`at`.`$rowname` ORDER BY `at`.`level` SEPARATOR ', ') FROM `address_tree` `at` WHERE `at`.`lft`<= `t`.`lft` AND `at`.`rgt` >= `t`.`rgt`) as 'fullname' FROM `address_tree` `t` WHERE `t`.`id` IN (" . implode(',', $ids) . ")  ORDER BY `t`.`level`;";

	    //$query = "SELECT * FROM `address_tree` `t`" ;
	    $resultarray = $this->dbquerytoarr($query);
	    foreach ($resultarray as $row)
		$result[] = $row['fullname'];
	}
	return $result;
    }

    //получение списка регионов
    public function getCityes($detected = 'ru') {
	$result = array();
	$rowname = ($detected=='ru')?'name':'name_en';
	$dbresult = $this
		->dbquerytoarr("SELECT `$rowname` as 'name', `id` as 'id', `lft` as 'lft', `rgt` as 'rgt',`level` as 'level' FROM `address_tree`
	    WHERE `address_tree`.`level` =" . $this->config['params']['citylevel']);

	foreach ($dbresult as $city) {
	    $result[mb_strtolower($city['name'],'UTF-8')] = $city;
	}
	return $result;
    }

    //получение наследников первого  уровня
    public function getChilds($parent,$detected = 'ru') {
	$result = array();
	$rowname = ($detected=='ru')?'name':'name_en';
	$query = "SELECT `$rowname` as 'name' FROM `address_tree`
	    WHERE `lft` > " . $parent['lft'] . " 
		AND `rgt` < " . $parent['rgt'] . " 
		AND `level` = " . ($parent['level'] + 1);


	$dbresult = $this->dbquerytoarr($query);
	foreach ($dbresult as $region) {
	    $result[] = $region['name'];
	}
	return $result;
    }

}

?>
