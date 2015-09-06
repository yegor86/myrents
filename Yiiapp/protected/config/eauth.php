<?php
return  array(
	    'class' => 'ext.eauth.EAuth',
	    'popup' => true, // Use the popup window instead of redirecting.
	    'services' => array(// You can change the providers and their classes.
		'facebook' => array(
		    'class' => 'FacebookOAuthService',
		      'client_id' => '438467102834285',
		    'client_secret' => '2bae8fc591a1697cf5205a59d7e16eed',
		),
		'vkontakte' => array(
		    'class' => 'VKontakteOAuthService',
		    'client_id' => '2922902',			//myrents.com.ua
		    'client_secret' => 'SlvyeHvqG5UZLmXUgJVP',	//myrents.com.ua
		),
	    ),
	);
?>
