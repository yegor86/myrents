<?php
date_default_timezone_set('Europe/Kiev');
defined('YII_DEBUG') or define('YII_DEBUG',true);
$yii=dirname(__FILE__).'/../../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main_loc.php';
//$yii=dirname(__FILE__).'/../framework/yiilite.php';
//$config=dirname(__FILE__).'/protected/config/main.php';
require_once($yii);
Yii::createWebApplication($config)->run();
