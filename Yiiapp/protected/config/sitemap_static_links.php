<?php
return array(
    //$_SERVER['SERVER_NAME']   в последствии заменяется на нужный адрес, (myrents.com.ua)
    
    
    //главная страница
    array(
	'loc'=> 'http://' . $_SERVER['SERVER_NAME']. '/',
	'lastmod'=>date("Y-m-d H:i:s"),
	'priority'=>1
	),

    //страница поддержки
   array(
	'loc'=> 'http://' . $_SERVER['SERVER_NAME']. '/support',
	'lastmod'=>date("Y-m-d H:i:s"),
	'priority'=>1
	),
    
);