
            
            <div id="subcontent"><div id="loading">
        <div class="sub_content_tabs">
    <ul class="sub_tabs">
	   <li class="boardtabsajax">
	      
	      <?php echo MRChtml::ajaxLink(
		      Yii::t('default', 'user.billsmenu.rent'), 
		      '/user/' . $user->id . '/hostings/rent/', 
		      array('id'=>'check1','update' => '#subcontent','updateUrl'=>true,'cache'=>false,'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:70px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>', 'type' => 'post',
			'data'=>array('filter'=>'js:$("#rents_sort").val()')
		  ),
		    array('id'=>'yf'.uniqid()) 
		); ?>
	  </li>
         <li class="boardtabsajax">
	    <?php echo MRChtml::ajaxLink(
		    Yii::t('default','user.billsmenu.sell'),
		    '/user/'.$user->id.'/hostings/sale', 
		    array('update'=>'#subcontent', 'cache'=>false,'updateUrl'=>true,'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:70px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>','type'=>'post',
			'data'=>array('filter'=>'js:$("#rents_sort").val()')
			), 
		    array('id'=>'yf'.uniqid())
		); ?>
         </li>
         <li class="boardtabsajax active_top">
	    <?php echo MRChtml::ajaxLink(
		    Yii::t('default','user.billsmenu.how_place_top'),
		    '/user/'.$user->id.'/hostings/how_place_top', 
		    array('update'=>'#subcontent', 'cache'=>false,'updateUrl'=>true,'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:70px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>','type'=>'post',
			'data'=>array('filter'=>'js:$("#rents_sort").val()')
			), 
		    array('id'=>'yf'.uniqid())
		); ?>
         </li>
      </ul>

            
            <div class="clr"></div>
      
      
      
        </div>

<div style="padding:30px 150px;">


<div class="in_block">
<center><b class="stl_2 icon_topmain"><?php echo Yii::t('default','sms.popup.window.text.header_main')?></b></center>
<p>Объявление будет размещено в галерею на главную страницу. Это увеличит количество просмотров вашего объявления.</p>
<center><?php echo CHtml::link('<span><b><i>'.Yii::t('default','up.button').'</i></b></span>','/up/place_main/',array('class'=>'abutton yellow uptop fancybox.ajax', 'style'=>'margin-top:15px;', 'id'=>'place_main'))?></center>
</div>
<div class="in_block">
<center><b class="stl_2 icon_topup">Топ объявления</b></center>
<p>Вы сможете разместить своё объявление в Топ списка для вашей категории. Вы сможете 
разместить своё объявление в Топ списка для вашей категории. Вы сможете разместить 
своё объявление в Топ списка для вашей категории.</p>
<center><?php echo CHtml::link('<span><b><i>'.Yii::t('default','up.button').'</i></b></span>','/up/place_top/',array('class'=>'abutton yellow uptop fancybox.ajax', 'style'=>'margin-top:15px;', 'id'=>'place_top'))?></center>
</div>


</div>
    </div>
</div>


<script type="text/javascript">
    $('.uptop').fancybox({
        'autoDimensions'	: false,
        'padding'		: 0,
        'autoScale':false,
        'centerOnScroll':true,
        'margin':5,
        'showCloseButton':false,
        'enableEscapeButton':false,
        'scrolling'		: 'no'
    });
</script>