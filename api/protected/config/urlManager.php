<?php

return array(
    'showScriptName' => false,
    'urlFormat' => 'path',
    'rules' => array(
	'gii' => 'gii',
//	'http://api.dev.myrents.com.ua/'=>'api/index',
	'http://api.dev.myrents.com.ua/<view:(rentlist|rentids)>/<apikey>'=>'api/rentslist',
	'http://api.dev.myrents.com.ua/<apikey>'=>'api/index',	
//	'http://api.rc.myrents.com.ua/'=>'api/index',
	'http://api.rc.myrents.com.ua/<view:(rentlist|rentids)>/<apikey>'=>'api/rentslist',
	'http://api.rc.myrents.com.ua/<apikey>/documentation'=>'api/documentation',
	'http://api.rc.myrents.com.ua/<apikey>'=>'api/index',
//	'http://api.loc.myrents.com.ua/'=>'api/rentslist',
	'http://api.loc.myrents.com.ua/<view:(rentlist|rentids)>/<apikey>'=>'api/rentslist',
	'http://api.loc.myrents.com.ua/<apikey>'=>'api/index',
	'http://api.myrents.com.ua/login'=>'login/wrong',
	'http://api.myrents.com.ua/<view:(rentlist|rentids)>/<apikey>'=>'api/rentslist',
	'http://api.myrents.com.ua/<apikey>'=>'api/index',

	

	'api_documentation'=>'apiDoc/apiDoc',

        
	'testpage' => 'test/test', //TODO: убрать - это тест
	'<lang:([a-zA-Z]{2})?>' => 'site/index',
	'login' => 'login/wrong',
	'sitemap.xml' => 'SEO/sitemapIndex',
	'sitemap_<type:[a-zA-Z]+>.xml' => 'SEO/sitemapLinks',
	'sitemap_<type:[a-zA-Z]+><count:\d+>.xml' => 'SEO/sitemapLinks',
	'remind/<lang:([a-zA-Z]{2})?>' => 'remindPass/remind',
	'remind' => 'remindPass/remind',
	'remind/<id:\d+>/<key:\w+>' => 'remindPass/resetPass',
	'remind/keysended' => 'remindPass/keySended',
	'remind/keysended/<lang:([a-zA-Z]{2})?>' => 'remindPass/keySended',
	'login/<lang:([a-zA-Z]{2})?>' => 'login/wrong',
	'setcurrency' => 'ajax/setcurrency',
	'switchRentView' => 'ajax/switchRentView',
	'switchLang' => 'ajax/switchLang',
	'getDescriptionForm' => 'ajax/DescrForm',
	'addfav' => 'ajax/addToFavorites',
	'regions' => 'ajax/regions',
	'wlogin/' => 'login/login',
	'wlogin/<service:[a-zA-Z]+>' => 'login/login',
	'register/<lang:([a-zA-Z]{2})?>' => 'register/register',
	'register' => 'register/register',
	'logout' => 'logout/logout',
	'help/<lang:([a-zA-Z]{2})?>' => 'help/index',
	'help' => 'help/index',
	'help/<alias:[-\w]+>/<lang:([a-zA-Z]{2})?>' => 'help/view',
	'help/<alias:[-\w]+>' => 'help/view',
        
        'members/' => 'members/',


        
        	'staticpage/<lang:([a-zA-Z]{2})?>' => 'staticpage/index',
	'staticpage' => 'staticpage/index',
	'staticpage/<alias:[-\w]+>/<lang:([a-zA-Z]{2})?>' => 'staticpage/view',
	'staticpage/<alias:[-\w]+>' => 'staticpage/view',
        

        
        
	'user/<lang:([a-zA-Z]{2})?>' => 'user/index',
	'user' => 'user/index',
	'user/confirm/<id:\d+>/<key:\w+>/<lang:([a-zA-Z]{2})?>' => 'activation/activation',
	'user/confirm/<id:\d+>/<key:\w+>' => 'activation/activation',
	'user/<id:\d+>/<action:info>' => 'user/user', //заворачиваем екшны info на индекс
	'user/<id:\d+>/<action:info>/<lang:([a-zA-Z]{2})?>' => 'user/user', //   
	'user/<id:\d+>/<action:hostings>' => 'user/<action>', // 
        'user/<id:\d+>/hostings/<action:how_place_top>' => 'user/<action>',
	'user/<id:\d+>/<action:hostings>/<lang:([a-zA-Z]{2})?>' => 'user/<action>', // 
	'user/<id:\d+>/<action:hostings>/<todourl:(rent|sale)>' => 'user/<action>', // 
	'user/<id:\d+>/<action:hostings>/<todourl:(rent|sale)>/<lang:([a-zA-Z]{2})?>' => 'user/<action>', // 
	//URL сообщений
	'user/<id:\d+>/messages/<type:(in|out)>' => 'messages/messages',
	'user/<id:\d+>/messages/<type:(in|out)>/<lang:([a-zA-Z]{2})?>' => 'messages/messages',
	'user/<id:\d+>/messages' => 'messages/messages',
	'user/<id:\d+>/messages/<lang:([a-zA-Z]{2})?>' => 'messages/messages',
	/*'user/<id:\d+>/messages/<messid:\d+>' => 'messages/read',
	'user/<id:\d+>/messages/<messid:\d+>/<lang:([a-zA-Z]{2})?>' => 'messages/read',*/
	'user/<id:\d+>/messages/send' => 'messages/send',
	'user/<id:\d+>/messages/send/<lang:([a-zA-Z]{2})?>' => 'messages/send',
	'user/<id:\d+>/messages/send/<receiver_id:\d+>' => 'messages/send',
	'user/<id:\d+>/messages/send/<receiver_id:\d+>/<lang:([a-zA-Z]{2})?>' => 'messages/send',
	'user/<id:\d+>/<action:[a-zA-Z]{3,}>' => 'user/<action>', // остальные екшны имеют свои действия
	'user/<id:\d+>/<action:[a-zA_Z]{3,}>/<lang:([a-zA-Z]{2})?>' => 'user/<action>', // остальные екшны имеют свои действия
	'user/<id:\d+>/<lang:([a-zA-Z]{2})?>' => 'user/user',
	'user/<id:\d+>' => 'user/user',
	'user/edit/<lang:([a-zA-Z]{2})?>' => 'userEdit/edit',
	'user/edit' => 'userEdit/edit',
	'user/edit/<widget:([a-zA-Z]{3,})>' => 'userEdit/widget',
	'user/chpass/<lang:([a-zA-Z]{2})?>' => 'userEdit/changepass',
	'user/chpass' => 'userEdit/changepass',
	'search/<lang:([a-zA-Z]{2})?>' => 'search/search',
	'search' => 'search/search',
	'search/<city:([-a-zA_Z]+)>' => 'presetSearch/search',
	'search/<city:([-a-zA_Z]+)>/<lang:([a-zA-Z]{2})?>' => 'presetSearch/search',
	'search/<city:([-a-zA_Z]+)>/<todo:(rent|sale)>' => 'presetSearch/search',
	'search/<city:([-a-zA_Z]+)>/<todo:(rent|sale)>/<lang:([a-zA-Z]{2})?>' => 'presetSearch/search',
	'search/<city:([-a-zA_Z]+)>/<todo:(rent|sale)>/<type:[a-zA_Z]+>' => 'presetSearch/search',
	'search/<city:([-a-zA_Z]+)>/<todo:(rent|sale)>/<type:[a-zA_Z]+>/<lang:([a-zA-Z]{2})?>' => 'presetSearch/search',	
	'search/<city:([-a-zA_Z]+)>/<todo:(rent|sale)>/<type:[a-zA_Z]+>/<room_count>' => 'presetSearch/search',
	'search/<city:([-a-zA_Z]+)>/<todo:(rent|sale)>/<type:[a-zA_Z]+>/<room_count>/<lang:([a-zA-Z]{2})?>' => 'presetSearch/search',
	'rent/<id:\d+>/<lang:([a-zA-Z]{2})?>' => 'rent/rent',
	'rent/<id:\d+>' => 'rent/rent',
	'rent/<id:\d+>/edit/<lang:([a-zA-Z]{2})?>' => 'rentEdit/edit', //повторяем для урл со сменой языков
	'rent/<id:\d+>/edit' => 'rentEdit/edit',
	'rent/<id:\d+>/edit/description/<lang:([a-zA-Z]{2})?>' => 'rentEdit/edit',
	'rent/<id:\d+>/edit/description' => 'rentEdit/edit',
	'rent/<id:\d+>/edit/photos/<lang:([a-zA-Z]{2})?>' => 'rentEditPhotos/edit',
	'rent/<id:\d+>/edit/photos' => 'rentEditPhotos/edit',
	'rent/<id:\d+>/edit/photos/upload' => 'rentEditPhotos/upload',
	'rent/<id:\d+>/edit/photos/uploadget' => 'rentEditPhotos/uploadget',
	'rent/<id:\d+>/edit/photos/delete/<photoid:\d+>' => 'rentEditPhotos/delete',
	'rent/<id:\d+>/edit/amenities/<lang:([a-zA-Z]{2})?>' => 'rentEditAmenities/edit',
	'rent/<id:\d+>/edit/amenities' => 'rentEditAmenities/edit',
	'rent/<id:\d+>/edit/place/<lang:([a-zA-Z]{2})?>' => 'rentEditPlace/edit',
	'rent/<id:\d+>/edit/place' => 'rentEditPlace/edit',
	'rent/<id:\d+>/drop/<lang:([a-zA-Z]{2})?>' => 'rentDrop/drop',
	'rent/<id:\d+>/drop' => 'rentDrop/drop',
	'rent/<id:\d+>/edit/neiborhood/<lang:([a-zA-Z]{2})?>' => 'rentEditNeiborhood/edit',
	'rent/<id:\d+>/edit/neiborhood' => 'rentEditNeiborhood/edit',
	'rent/<id:\d+>/edit/pricing_and_terms/<lang:([a-zA-Z]{2})?>' => 'rentEditTerms/edit',
	'rent/<id:\d+>/edit/pricing_and_terms' => 'rentEditTerms/edit',
	'rent/list/<lang:([a-zA-Z]{2})?>' => 'rentCreate/create',
	'rent/list' => 'rentCreate/create',
	'rent/translate/<id:\d+>' => 'rentTranslate/translate', //переводчик 
	'feed/import' => 'import/xml',
	'support' => 'support/support',
        'payments' => 'payments/payments',
	'up/<id:\d+>' => 'up/toUp',
        'up/global' => 'up/toUpGlobal',
        'up/noaccess' => 'up/ToNoaccess',
        'up/free' => 'up/ToFree',

        'up/place_top' => 'up/toPlaceTop',
        'up/place_main' => 'up/toPlaceMain',
	'translatetree' => 'translateAddress/treeTranslator',
	'translateaddress' => 'translateAddress/addressTranslator',
	/* Admin pages */
        
        
	'admin' => 'adminPage/adminMain',
	'admin/user' => 'adminUsers/adminUsers',
	'admin/user/<id:\d+>' => 'adminUsers/adminUsersEdit',
	'admin/user/<id:\d+>/delete' => 'adminUsers/adminUsersDel',
        'admin/user/emailList' => 'adminUsers/adminUsersEmailList',
        'admin/user/notify' => 'adminUsers/adminSingleNotify',
        'admin/user/<date:[-\w]+>' => 'adminUsers/adminUsersDate',
        
	'admin/settings' => 'adminSettings/adminSettings',
	'admin/rents' => 'adminRents/adminRents',
	'admin/rents/<id:\d+>' => 'adminRents/adminRentsEdit',
	'admin/rents/user/<userId:\d+>' => 'adminRents/adminRentsUser',
	'admin/rents/showmain' => 'adminRents/adminRentsShowmain',
        

        'admin/rents/<date:[-\w]+>' => 'adminRents/adminRentsDate',
        
        
	'admin/clear' => 'adminPage/adminClear', //TODO: чистлика ассетсов - убрать
	'admin/admins' => 'adminPage/adminAdmins',
	'admin/filters/amenities' => 'adminFilters/adminAmenities',
	'admin/filters/amenities/<id:\d+>' => 'adminFilters/adminAmenitiesEdit',
	'admin/filters/neiborhood' => 'adminFilters/adminNeiborhood',
	'admin/filters/neiborhood/<id:\d+>' => 'adminFilters/adminNeiborhoodEdit',
	'admin/filters' => 'adminFilters/adminMain',
	
        'admin/support' => 'adminSupport/adminSupport',
        
        'admin/partners' => 'adminPartners/adminPartners',
        'admin/partners/edit/<id:\d+>' => 'adminPartners/adminPartnersEdit',
        'admin/partners/delete/<id:\d+>' => 'adminPartners/adminPartnersDelete',
        'admin/partners/add' => 'adminPartners/adminPartnersAdd',

        'admin/staticpage' => 'adminStaticPage/adminStaticPage',
        'admin/staticpage/edit/<id:\d+>' => 'adminStaticPage/adminStaticPageEdit',
        'admin/staticpage/add' => 'adminStaticPage/adminStaticPageAdd',
        'admin/staticpage/delete/<id:\d+>' => 'adminStaticPage/adminStaticPageDelete',
        
        'admin/help' => 'adminHelp/adminHelp',
        'admin/help/add' => 'adminHelp/adminHelpAdd',
        'admin/help/edit/<id:\d+>' => 'adminHelp/adminHelpEdit',
        'admin/help/delete/<id:\d+>' => 'adminHelp/adminHelpDelete',

        'admin/seopage' => 'adminSeoPage/adminSeoPage',
        'admin/seopage/edit/<lang:[a-z]{2}>/<url:[-_\%\w]+>' => 'adminSeoPage/adminSeoPageEdit',
        
        'admin/seopage/add/<lang:[a-z]{2}>' => 'adminSeoPage/adminSeoPageAdd',
        

        'admin/comments' => 'adminComments/adminComments',
        'admin/comments/delete/<id:\d+>' => 'adminComments/adminCommentsDelete',
	'admin/yandex.xml'=>'yrl/xml',

	/*api page */
	/*'api/<view:(rentlist|rentids)>/<apikey>'=>'api/rentslist',
        'api/<apikey>/documentation'=>'api/documentation',
	'api/<apikey>'=>'api/index',
	*/
	
        'sms/10543c8c70bfe4763837861685a32395Bou4gsBFnV0GYg6EOxgimSlovIO29B8Tkr6wbKQ1bF7WTCO4LRLcjCdp7Z'=>'sms/incoming',
        
    ),);
?>
