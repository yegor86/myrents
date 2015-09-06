<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Console Application',
    // application components
    'commandMap' => array(
	'migrate' => array(
	    'class' => 'system.cli.commands.MigrateCommand',
	    'migrationPath' => 'application.migrations',
	    'migrationTable' => 'tbl_migration',
	    'connectionID' => 'db',
	//    'templateFile' => 'application.migrations.template',
	),),
    'components' => array(
	'db' => array(
	    'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
	),
	// uncomment the following to use a MySQL database

	'db' => array(
	    'connectionString' => 'mysql:host=localhost;dbname=myrentsdb',
	    'emulatePrepare' => true,
	    'username' => 'yii',
	    'password' => 'yiipass',
	    'charset' => 'utf8',
	),
    ),
);