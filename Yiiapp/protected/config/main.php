<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'MyRents',
    // preloading 'log' component
    'preload' => array('log'),
    'language' => 'ru',
    'sourceLanguage' => 'system',
    'charset' => 'utf-8',
    // autoloading model and component classes
    'import' => array(
	'application.models.*',
	'application.models.forms.*',
	'application.models.activerecords.*',
	'application.components.*',
	'ext.eoauth.*',
	'ext.eoauth.lib.*',
	'ext.lightopenid.*',
	'ext.eauth.services.*',
	'application.extensions.nestedset.*',
	'application.extensions.ArrayOfIdsRelation',
	'application.extensions.Text_LanguageDetect.Text.*',
    ),
    'aliases'=>array(
	'xupload'=>'ext.xupload'
    ),
    'modules' => array(
    // uncomment the following to enable the Gii tool
    ),
    // application components
    'components' => array(
	'search' => array(
	    'class' => 'application.extensions.DGSphinxSearch.DGSphinxSearch',
	    'server' => 'localhost',
	    'port' => 9312,
	    'maxQueryTime' => 3000,
	    'enableProfiling' => 0,
	    'enableResultTrace' => 0,
	    'fieldWeights' => array(
		'name' => 10000,
		'keywords' => 100,
	    ),
	),
    'putils' => array(
        'class' => 'application.components.PathUtils'
    ),
	'bing'=>array(
	    'class' => 'application.extensions.BingTranslator.BingTranslator',
	      /**
	     * Microsoft access token 
	     */
	    
	    /**
	     // зарегистрирован на support@myrents.com.ua 
	     
	    'microsoft_client_id' => 'myrents',
	    'microsoft_client_name' => 'myrents.com.ua',
	    'microsoft_client_secret' => 'ic9R0wU2d9wKpnCLHHbowhdK58Df+wX3nUIJbCObkyY=',
	    */
	    
	    //заврегистрирован на yawa20@gmail.com
	    'microsoft_client_id' => 'myrentscomua',
	    'microsoft_client_name' => 'myrents.com.ua',
	    'microsoft_client_secret' => 'QVFuh8Z98sIUnlaGNP2kZLdGgV7lwQXnPchK8hX4r8w=',
	    

	    'microsoft_scope' => 'http://api.microsofttranslator.com',
	    'microsoft_grant_type' => 'client_credentials',
	    'microsoft_auth_url' => 'https://datamarket.accesscontrol.windows.net/v2/OAuth2-13/',  
	    
	),
	'clientScript' => array(
	    'class' => 'application.components.NLSClientScript',
	    'excludePattern' => '/\.tpl/i', //js regexp, files with matching paths won't be filtered is set to other than 'null'
//'includePattern' => '/\.php/' //js regexp, only files with matching paths will be filtered if set to other than 'null'
	),
	'user' => array(
	    // enable cookie-based authentication
	    'allowAutoLogin' => true,
	    'loginUrl' => array('/login'),
	    'class' => 'WebUser'
	),
	'authManager' => array(
	    'class' => 'CDbAuthManager',
	    'connectionID' => 'db',
	),
	/* image handler */
	'ih' => array(
	    'class' => 'CImageHandler',
	),
	// uncomment the following to enable URLs in path-format

	'urlManager' => require(dirname(__FILE__) . '/urlManager.php'),
	'cache' => array(
	    'class' => 'CMemCache',
	    'useMemcached' => true,
	    'keyPrefix'=>'MyRents_key',
	    'servers' => array(
		array(
		    'host' => 'localhost',
		    'port' => 11211,
		),
	    ),),
	'db' => array(
	    'class'=>'RDbConnection',
	    'connectionString' => 'mysql:host=localhost;dbname=myrentsdb',
	    'emulatePrepare' => true,
	    'username' => 'yii',
	    'password' => 'yiipass',
	    'charset' => 'utf8',
	    'enableProfiling' => false,
	    'schemaCachingDuration' => 3600
	),
	'errorHandler' => array(
	    // use 'site/error' action to display errors
	    'errorAction' => 'site/error',
	),
	'log' => array(
	    'class' => 'CLogRouter',
	    'routes' => array(
		array(
		    'class' => 'CFileLogRoute',
		    'enabled' => true, //лог, включен
		    'levels' => 'error', // лог ошибок
		    'categories' => '', //лог все категории
		    'logFile' => 'error.log', // файл лога
		    'logPath' => 'log'    //директория логов
		),
		array(
		    'class' => 'CFileLogRoute',
		    'enabled' => true, //лог, включен
		    'levels' => 'info', // лог ошибок
		    'categories' => 'SMS', //лог все категории
		    'logFile' => 'sms.log', // файл лога
		    'logPath' => 'log'    //директория логов
		),
		array(
		    'class' => 'CFileLogRoute',
		    'enabled' => true, //  лог, включен
		    'levels' => 'warning', // лог ошибок
		    'categories' => '', //лог все категории
		    'logFile' => 'warning.log', // файл лога
		    'logPath' => 'log'    //директория логов
		),
		array(
		    'class' => 'CFileLogRoute',
		    'enabled' => true, //  лог, включен
		    'levels' => 'trace', // лог ошибок
		    'categories' => '', //лог все категории
		    'logFile' => 'trace.log', // файл лога
		    'logPath' => 'log'    //директория логов
		),
		array(
		    'class' => 'CFileLogRoute',
		    'levels' => 'error',
		    'categories' => 'system.db.*',
		    'logFile' => 'sql.log',
		    'logPath' => 'log'    //директория логов			
		),
	    ),
	),
	'loid' => array(
	    'class' => 'ext.lightopenid.loid',
	),
	'eauth' => require(dirname(__FILE__) . '/eauth.php'),
	'email' => array(
	    'class' => 'application.extensions.email.Email',
	    'delivery' => 'php', //Will use the php mailing function.
	//May also be set to 'debug' to instead dump the contents of the email into the view
	),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']

    'params' => require(dirname(__FILE__) . '/params.php'),
);
