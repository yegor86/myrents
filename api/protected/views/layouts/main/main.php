<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/slide.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tipTip.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.jscrollpane.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.ad-gallery.css" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.jscrollpane.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/menu.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.tipTip.js"></script>
<script type="text/javascript">
	jQuery(function($){
		$("#tabs").tabs();
                $("#tabs2").tabs();
                $("#accordion").accordion({active: false, collapsible: true, autoHeight: false, animated: false});
                $("#accordion_edit_rent").accordion({collapsible: true, navigation: true, autoHeight: false, animated: false});
	});
jQuery(function($){
		$('.scroll-pane').jScrollPane({showArrows: true});
	});

jQuery(document).ready(function($) {
    $('#mycarousel').jcarousel();
});
	jQuery(function($){
		$(".pop").tipTip({maxWidth:"150px", edgeOffset:1});
	});
	jQuery(function($) {
		$( "#slider-range" ).slider({
			range: true,
			min: 1000,
			max: 10000,
			values: [ 1440, 7545 ],
			slide: function( event, ui ) {
				$( "#price_max" ).val( "$" + ui.values[ 1 ] );
				$( "#price_min" ).val( "$" + ui.values[ 0 ]);
			}
		});
		$( "#price_max" ).val( "$" + $( "#slider-range" ).slider( "values", 1 )  );
		$( "#price_min" ).val( "$" + $( "#slider-range" ).slider( "values", 0 )  );


		$( "#slider-range2" ).slider({
			range: true,
			min: 0,
			max: 5000,
			values: [ 0, 2660 ],
			slide: function( event, ui ) {
				$( "#price_max2" ).val( "$" + ui.values[ 1 ] );
				$( "#price_min2" ).val( "$" + ui.values[ 0 ]);
			}
		});
		$( "#price_max2" ).val( "$" + $( "#slider-range2" ).slider( "values", 1 )  );
		$( "#price_min2" ).val( "$" + $( "#slider-range2" ).slider( "values", 0 )  );	
	});
</script>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

    <body>
<div class="globalcontainer">
  <div class="head"><a href="/" class="logo"></a>
      
      <!--
      
      	<div >
		
	</div>
      
      
      
      -->
      
  <div class="headmenu" id="mainmenu">
      <?php  $isGuest=Yii::app()->user->isGuest; ?>
       
       
    <ul>
                      <?php if(!$isGuest){?>
<li id="authorization"><?php echo CHtml::link(Yii::app()->user->name.' <img src="/images/arr_down.png" border="0" width="9" height="7" alt="" />','javascript: void(0)', array('class'=>'menu_h_border mlink'))?>


<div id="authorization_pop">
            <div class="close_layer"></div>
            <div style="position: relative;z-index: 50" class="popup_box">
                <div id="close_user_list_pop"><?php echo CHtml::link(Yii::app()->user->name.' <img src="/images/arr_up.png" border="0" width="9" height="7" alt="" />','javascript:void(0)', array('class'=>'mlink'))?></div>
                <div><?php echo CHtml::link('Profile','/user/'.Yii::app()->user->id, array('class'=>'mlink'))?></div>
                <div><a href="#" class="mlink">Messages <span>(3)</span></a></div>
                <div class="last"><?php echo CHtml::link(Yii::t('default','Выход'),'/logout', array('class'=>'mlink'))?></div>
            </div>
            </div>
    

</li>  
        <?php }?>
      <li id="currency"><div class="menu_h_border"><span class="flt_l"><?php echo Yii::t('default','Валюта')?>:</span> <a class="mlink rub flt_r" href="#">Rub <img src="/images/arr_down.png" width="9" height="7" border="0" alt="" /></a>
              <div class="clr"></div>
            <div id="currency_pop">
    <div class="close_layer"></div><div class="popup_box" style="position: relative;z-index: 100">

<div id="close_currency_pop" style="padding: 0 0 5px 0"><span class="flt_l"><?php echo Yii::t('default','Валюта')?>:</span> <a class="mlink rub flt_r" href="#">Rub <img src="/images/arr_up.png" width="9" height="7" border="0" alt="" /></a></div>
<div class="clr"></div>

    <div><a href="#" class="mlink" style="border-top: 1px solid #ffb32c;">Гривна</a></div>
    <div style="margin-bottom: 3px;"><a href="#" class="mlink">Доллар</a></div>

</div> 
</div> 
              </div> 
</li>

        <?php 
        $langs = Language::model()->findAll();
        $curlang = Language::model()->findByAttributes(array('language'=>Yii::app()->language));
        ?>
      <li id="lang"><div class="menu_h_border"><?php echo CHtml::link($curlang->name.' <img src="/images/arr_down.png" border="0" width="9" height="7" alt="'.$curlang->language.'" />','javascript:void(0)',array('class'=>'mlink lang_'.$curlang->language, 'style'=>'padding-left:20px;')) ?>
      
      
      <div id="lang_pop">
          
          <div class="close_layer"></div>
            <div class="popup_box" style="padding-bottom: 3px;">
                <div id="close_lang_pop" style="padding: 1px 3px 0px 11px;border-bottom: 1px solid #ffb32c;"><?php echo CHtml::link($curlang->name.' <img src="/images/arr_up.png" border="0" width="9" height="7" alt="'.$curlang->language.'" />','javascript:void(0)',array('class'=>'mlink lang_'.$curlang->language,  'style'=>'padding-left:20px')) ?></div>

    <?php foreach ($langs as $lang) {
        $checked = '';
    if ($lang==$curlang) $checked = 'current'
     ?>
    

     <div style="padding: 1px 3px 0 11px;"><?php echo CHtml::ajaxLink($lang->name, '/setlang',array('type'=>'post','data'=>'language='.$lang->language,'update'=>'#refreshdiv'), array('class'=>'mlink lang_'.$lang->language.' '.$checked, 'style'=>'padding-left:20px')) ?></div>
    <?php }?>
 <div id="refreshdiv"></div></div>

</div>
</div>
</li>
        
    
      <?php if($isGuest){?>
        <li><div class="menu_h_border"><?php echo CHtml::link(Yii::t('default','Регистрация'),'/register', array('class'=>'mlink'))?></div></li>
        
      <li id="singin"><div class="menu_h_border"><a href="#" class="mlink"><?php echo Yii::t('default','Вход') ?> <img src="/images/arr_down.png" border="0" width="9" height="7" alt="" /></a>
    
      <!-- SING IN BLOCK --> 
<div id="login_pop">
    <div class="close_layer"></div><div style="position: relative;z-index: 100">
        <div class="all_close">
    <span class="popup_title"><a id="close_login_pop" href="#"><?php echo Yii::t('default','Вход') ?> <img src="/images/arr_up.png" border="0" width="9" height="7" alt="" /></a></span></div>
        <div class="headmenu_popup">
<div class="sing_in_block">

			<?php $this->widget('application.extensions.login.XLoginPortlet',array(
     'visible'=>Yii::app()->user->isGuest,
)); ?>
</div>
</div>
</div>

</div>
      </div>
<!-- SING IN BLOCK --> 

      </li>
<?php }?>
    </ul>
  </div>
      <a class="listyourspace btn_border abutton blue" href="/rent/list"><span><b><i><?php echo Yii::t('default','Сдать жильё') ?></i></b></span></a>
  </div>
      <div id="insideblock"><?php echo $content; ?></div>
<!-- mainmenu -->

  <ul class="footmenu">
    <li><a href="#">Terms of use</a></li>
    <li><a href="#">Support</a></li>
    <li><a href="#">Help</a></li>
    <li><a href="#">Suport</a></li>
  </ul>


</body>
</html>