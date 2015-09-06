<div id="ajax_popup">
  
<div class="popup_head"><h2><?php echo Yii::t('default', 'place.in.top') ?> <img id="loading_popup" style="display:none" src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt="Loading"></h2></div>
<div id="popup_container" style="width:550px;padding:0 0 20px 0;height: 330px">
    
        <div class="section_box"><div class="viewpop"><div class="popup_viewpop"><img src="<?php echo $this->getAssetsUrl()?>/images/tiptip_main.jpg" alt="" /></div></div>
    <b class="stl_2 icon_topmain">Разместить объявление на главную страницу</b><br/>
    Объявление будет размещено в галерею на главную страницу. 
Это увеличит количество просмотров вашего объявления.

<div><?php echo CHtml::link('<span><b><i>'.Yii::t('default','up.button').'</i></b></span>','javascript:void(0)',array('class'=>'abutton yellow', 'style'=>'margin-top:15px;', 'id'=>'place_main'))?>  <img id="loading_main" style="display: none;" src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt=""></div>
    </div>
    
    <div class="section_box"><div class="viewpop"><div class="popup_viewpop"><img src="<?php echo $this->getAssetsUrl()?>/images/tiptip_top.jpg" alt="" /></div></div>
    <b class="stl_2 icon_topup">Топ-объявления</b><br/>
    Вы сможете разместить своё объявление в Топ списка для вашей 
категории. 
<div><?php echo CHtml::link('<span><b><i>'.Yii::t('default','up.button').'</i></b></span>','javascript:void(0)',array('class'=>'abutton yellow', 'style'=>'margin-top:15px;', 'id'=>'place_top'))?>  <img id="loading_top" style="display: none;" src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt=""></div>

    </div>

    
    <div class="section_box" style="border-bottom:0;">
<?php if($userUpsCount) {?>
    
<p>Так же вы можете <b>бесплатно <?php echo CHtml::link(Yii::t('default','up.button'),'/up/'.$rent->id.'',array('id'=>'confirm'.$rent->id, 'style'=>'margin-top:15px;'))?></b>  одно обьявление на первое место в категории к которой пренадлежит объявление.</p>


<span id="loading_up" style="display:none"><img src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt=""></span>
<?php } else {?>
<b style="color:#c94718"><?php echo Yii::t('default','up.today you reached your limit');?></b>
<?php } ?>
</div>
</div>
</div>


<script type="text/javascript">
  $(function() {  
      $('#confirm<?php echo $rent->id ?>').click(function(){
        $('#loading_popup').css({'display':'inline'});
	$.ajax({
	    url:$(this).attr('href'),
	    type:'post',
	    data:{confrmed:true, id:'<?php echo $rent->id;?>'},
	    success:function(resultdata) {
		$('#ajax_popup').html(resultdata);
                $('#loading_popup').hide();
	    }
	});
	return false;
      });



      $('#place_top').click(function(){
        $('#loading_popup').css({'display':'inline'});

        var a = $(this);
	$.ajax({
	    url: '/up/place_top/',
	    type:'post',
	    data:{id:'<?php echo $rent->id;?>'},
	    success:function(resultdata) {

		$('#ajax_popup').html(resultdata);
                $('#loading_popup').hide();
	    }
	});
	return false;
      });
      
      
      
            $('#place_main').click(function(){
        $('#loading_main').show();
	$.ajax({
	    url: '/up/place_main/',
	    type:'post',
	    data:{id:'<?php echo $rent->id;?>'},
	    success:function(resultdata) {
		$('#ajax_popup').html(resultdata);
                $('#loading_main').hide();
	    }
	});
	return false;
      });
  });
</script>