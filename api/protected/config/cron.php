<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Cron',
    'preload' => array('log'),
    'import' => array(
	'application.components.*',
	'application.models.*',
    ),
    // application components
    'components' => array(
	// uncomment the following to use a MySQL database
	'cache' => array(
	    'class' => 'CMemCache',
	    	    'keyPrefix'=>'MyRents_key',
	    'useMemcached' => true,
	    'servers' => array(
		array(
		    'host' => 'localhost',
		    'port' => 11211,
		),
	    ),),
	'db' => array(
	    'connectionString' => 'mysql:host=localhost;dbname=myrentsdb',
	    'emulatePrepare' => true,
	    'username' => 'yii',
	    'password' => 'yiipass',
	    'charset' => 'utf8',
	),
	'log' => array(
	    'class' => 'CLogRouter',
	    'routes' => array(
		array(
		    'class' => 'CFileLogRoute',
		    'logFile' => 'cron.log',
		    'levels' => 'error, warning',
		    'logPath' => '/var/log/myrents_cron_log'
		),
		array(
		    'class' => 'CFileLogRoute',
		    'logFile' => 'cron_trace.log',
		    'levels' => 'trace',
		    'logPath' => '/var/log/myrents_cron_log'
		),
	    ),
	),
    ),
);