<div id="ajax_popup">
  
<div class="popup_head"><h2><?php echo Yii::t('default', 'place.in.top') ?> <img id="loading_popup" style="display:none" src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt="Loading"></h2></div>
<div id="popup_container" style="width:550px;padding:0 0 20px 0;height: 330px">
    
        <div class="section_box"><div class="viewpop"><div class="popup_viewpop"><img src="<?php echo $this->getAssetsUrl()?>/images/tiptip_main.jpg" alt="" /></div></div>
    <b class="stl_2 icon_topmain"><?php echo Yii::t('default','sms.popup.window.text.header_main');?></b><br/>
    
<?php echo Yii::t('default','sms.popup.window.text.header_main.desc');?> 
<div><?php echo CHtml::link('<span><b><i>'.Yii::t('default','up.button').'</i></b></span>','javascript:void(0)',array('class'=>'abutton yellow', 'style'=>'margin-top:15px;', 'id'=>'place_main'))?></div>
    </div>
    
    <div class="section_box"><div class="viewpop"><div class="popup_viewpop"><img src="<?php echo $this->getAssetsUrl()?>/images/tiptip_top.jpg" alt="" /></div></div>
    <b class="stl_2 icon_topup"><?php echo Yii::t('default','sms.popup.window.text.header_top');?></b><br/>
    <?php echo Yii::t('default','sms.popup.window.text.header_top.desc');?> 
<div><?php echo CHtml::link('<span><b><i>'.Yii::t('default','up.button').'</i></b></span>','javascript:void(0)',array('class'=>'abutton yellow', 'style'=>'margin-top:15px;', 'id'=>'place_top'))?></div>

    </div>

    
    <div class="section_box" style="border-bottom:0;">
<?php if($userUpsCount) {?>

<?php echo Yii::t('default', 'sms.popup.window.text.free_part1') ?> <?php echo Yii::t('default', 'sms.popup.window.text.free_part2',array('{id}'=>$rent->id)); ?> <?php echo Yii::t('default', 'sms.popup.window.text.free_part3'); ?>

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
        $('#loading_popup').css({'display':'inline'});
	$.ajax({
	    url: '/up/place_main/',
	    type:'post',
	    data:{id:'<?php echo $rent->id;?>'},
	    success:function(resultdata) {
		$('#ajax_popup').html(resultdata);
                $('#loading_popup').hide();
	    }
	});
	return false;
      });
  });
</script>