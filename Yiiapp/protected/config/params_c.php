<?php

/**
 * тут различные параметры, используемые глобально
 */
return array(
    'support_recipier' => 'support@myrents.com.ua', //email получателя писем техподдержки
    'suport_sender' => 'Myrents support service <support@myrents.com.ua>', //email отправщика писем в техподдержку
    'adminEmail' => 'Myrents registration service <registration@myrents.com.ua>', //email отправщика писем регистрации
    'reminder_sender' => 'Myrents reminder <reminder@myrents.com.ua>', //email отправщика напоминалки пароля
     'noreplyEmail' => 'Myrents notification <notification@myrents.com.ua>', //email отправщика напоминалки пароля
//директории
    'UPLOADDIR' => '/uploads/', //папка для загрузок по умолчанию
    'TEMPDIR' =>'/uploads/tmpdir/',
    'THUMBDIR' => 'thumbs/', //подпапка иконок 
    'USERPHOTOSDIR' => '/uploads/userpic/', //папка аватаров пользователей
    'AGENCYIMAGESDIR'=>'/uploads/agencypic/', //папка картинки агенста
    'AGENCYDOCSDIR'=>'/uploads/agencydocs/', //папка картинки агенста
    'RENTPHOTOSDIR' => '/uploads/rentpic/', //папка фотографий аренд
    'MAILERFILENAME'=>'mailcontent',
    'assets' => '/views/assets', //папка с файлами
    'api_execution_step'=>1,
//параметры поиска и вывода на страницу
    'resultsPerPage' => 15, // результатов на странице
        'adminResultsPerPage' => 50, // результатов на странице
    'memberlistPerPage'=>50,
    'rentsOnMap'=>200,
    'maxbuttonCount' => 7, //кнопочек на пагинаторе
    'minletters' => 1, //минимальное количество букв для поиска в выпадающем списке
    'startlevel' => 1, //уровень, с которого начинается поиск 0- Страна, 1- область
    'citylevel' => 2, //уровень, на котором искать города
    'AdressPrefix' => '', //префикс адреса по умолчанию
    'maximagesize' => array('width' => 4000, 'height' => 4000), //максимальные размеры обрабатываемой картинки
    'langs' => array('ru', 'en', 'ua'), //список доступных языков
    'isnew' => 259200, //время, в течении которого объявление считается новым (в секундах), установлено в 3 дня
    'comment_isnew' => 259200, //время в админки(комменты), в течении которого комментарий считается новым (в секундах), установлено 3 для
//переменные для сео-страниц
    'freeUpsByDay'=>1,//количество бесплатных апов в день
    'needCapcha'=>true,
    'seoLinksparam'=>array(
	0=>'CityesUrl',
	2=>'TodoUrl',
	3=>'TypeUrl',
	4=>'RoomsUrl'
    ),
    'logdir' => '/log/',
    'TodoUrl' => array(
	'rent' => 1,
	'sale' => 2
    ),
    'TypeUrl' => array(
	'flat' => 1,
	'house' => 2,
	'office' => 3
    ),
    'RoomsUrl' => array(
	'1-room' => 1,
	'2-room' => 2,
	'3-room' => 3,
	'4-room' => 4,
    ),
    'order_rows' => array(
	'creation_date' => 'search.order.date',
	'price' => 'search.order.price',
    ),
    'rooms' => array(
	'1' => '1',
	'2' => '2',
	'3' => '3',
	'4' => '4',
	'5' => '5+'
    ),
    'floors_search_queries' => array(
	'1' => 'BETWEEN 1 AND 4',
	'2' => 'BETWEEN 5 AND 9',
	'3' => 'BETWEEN 10 AND 15',
	'4' => ' > 15',
    ),
    'floors_to_search' => array(
	'ru' => array(
	    '0' => 'Любой',
	    '1' => '1-4',
	    '2' => '5-9',
	    '3' => '10-15',
	    '4' => '15+'
	),
	'ua' => array(
	    '0' => 'Будь-який',
	    '1' => '1-4',
	    '2' => '5-9',
	    '3' => '10-15',
	    '4' => '15+'
	),
	'en' => array(
	    '0' => 'Any',
	    '1' => '1-4',
	    '2' => '5-9',
	    '3' => '10-15',
	    '4' => '15+'
	)
    ),
    'floors_to_edit' => array(
	'1' => '1',
	'2' => '2',
	'3' => '3',
	'4' => '4',
	'5' => '5',
	'6' => '6',
	'7' => '7',
	'8' => '8',
	'9' => '9',
	'10' => '10',
	'11' => '11',
	'12' => '12',
	'13' => '13',
	'14' => '14',
	'15' => '15+'
    ),
    'prices' => array(// диапазоц цен для поиска
	'min' => 1,
	'max' => 10000
    ),
    'prices_sale'=>array(
	'min'=>1,
	'max'=>1000000
    ),
    'squares' => array(//диапазон площадей для поиска
	'min' => 1,
	'max' => 300
    ),
    'current_price' => array(//для вывода текущих цен
	'1' => array('row' => 'price_day', 'name' => 'за день','sname'=>'день'),
	'2' => array('row' => 'price_week', 'name' => 'за неделю','sname'=>'неделя'),
	'3' => array('row' => 'price_month', 'name' => 'за месяц','sname'=>'месяц'),
    ),
    'watermark' => array(//водный знак
	'image' => 'protected/staff/watermark.png',
	'x' => 20,
	'y' => 20,
        'corner' => 4, //LEFT_TOP = 1;RIGHT_TOP = 2;LEFT_BOTTOM = 3;RIGHT_BOTTOM = 4;CENTER = 5;
    ),
    'updatePeriods'=>array( //периоды после обновления, пара выодимое значение, и число меньше которого оно работает
	'0'=>array(0,3),
	'3'=>array(3,6),
	'7'=>array(7,13),
	'14'=>array(14,9999)
    ),
    
    'ShowGuide'=>2, // Количество объявлений на главной при котором будут выводится Guide(help)
    
    //различные параметры по умолчанию 
    'Currency' => 3, // id валюты по умолчанию (гривна)
    'requiredLang' => 1, //idшник обязательного языка
    'phonesCount' => 3,
    'maxsimilar' => 15, //максимальное количество ближайших аренд
    'kilometerSimilarRadius' => 2, // радиус ближайших аренд в километрах
    'cornerRadius' => 0.00145902, // угловая разница координат (2км) для поиска близлежащих аренд
    'geoOnKilometer' => 112.2, //геокоординатных единиц в километре, для перевода из км в координты следует делить
    ////различные глобальные константы
    'SessionTime' => 3600 * 24 * 30, //время сессии, в секундах
    'cachetime' => 3600, //время хранения кешированных данных, в секундах
  //'yandexKey' => 'AOz-PE8BAAAA7h7MbAIACXQiLQwVXAuT9Aon-IV8qCjEhJwAAAAAAAAAAACQ7pO3mSMuGmC_D_RFI52LaeAaLw==',  //yiiapp.loc
   'yandexKey' => 'AH0AmE8BAAAAlxPKcAMATlNZlo8j5FesUOkL6I5jdx6ejsIAAAAAAAAAAAA6xq4c44nXRsdFLskA2d6QEO8VEg==', //myrents.com.ua
//  'yandexKey'=>'AA-PyE8BAAAACrsIDwMA9uvpCsK0u0PsIzx-etx3HjB4WloAAAAAAAAAAABDhRBH0fBGvXJqUiElyZrCPLZaSA=='
    
    
    //коды стран, которые по умолчанию локализируются нарусском
    'default_ru_localization_counrty_codes'=>array(
	'RU', 'UA','BR','KZ'
   ),
    'topCount'=>4, //количество элементов в топе
    'smsbillmainprefix'	=> 'zz5',
    'smsbillMRprefix'	=> '4932',
    'smsbill_secret'=>'soundmoderator',
    'billingActions'=>array('t','m'),
    'smsTopPeriods'=>array(
	'8313'=>array('name'=>'top.per.day','price'=>'4.17 грн.','periodInDays'=>3),
	'576'=>array('name'=>'top.per.three.day','number'=>'333','price'=>'8.33 грн.','periodInDays'=>7),
	'3161'=>array('name'=>'top.per.seven.day','number'=>'777','price'=>'12.50 грн.','periodInDays'=>14),
	),
   'smsMainPeriods'=>array(
	//'4540'=>array('name'=>'main.per.day','price'=>'5.00 грн.','periodInDays'=>3),
	'5060'=>array('name'=>'main.per.three.day','number'=>'333','price'=>'25.00 грн.','periodInDays'=>7),
	//'4449'=>array('name'=>'main.per.seven.day','number'=>'777','price'=>'16.00 грн.','periodInDays'=>14),
        ),
    
    'mailerMaxChildProcess'=>2, //
    'mailerDaemonCheckPeriod'=>1, //время в секундах проверки демоном
    'mailersleep'=>100, //время в милисекундах между отправками сообщений
    )
?>
