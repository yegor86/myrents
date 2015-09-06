<div id="ajax_popup">
<div class="popup_head"><h2><?php echo Yii::t('default', 'place.in.top') ?> 
    <img id="loading_popup" style="display:none" src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt="Loading"></h2></div>
<div id="popup_container" style="width:550px;padding:20px 0 20px 0;height: 340px">

        <div class="section_box"><div class="viewpop"><div class="popup_viewpop"><img src="<?php echo $this->getAssetsUrl()?>/images/tiptip_main.jpg" alt="" /></div></div>
    <b class="stl_2 icon_topmain"><?php echo Yii::t('default','sms.popup.window.text.header_main');?></b><br/>
<?php echo Yii::t('default','sms.popup.window.text.header_main.desc');?> 

<div>
    <?php if (!Yii::app()->user->isGuest){ ?>
        <?php echo CHtml::link('<span><b><i>'.Yii::t('default','up.button').'</i></b></span>','javascript:void(0)',array('class'=>'abutton yellow', 'style'=>'margin-top:15px;', 'id'=>'place_main'))?>
    <?php } else {?>
    <?php echo CHtml::link('<span><b><i>'.Yii::t('default','up.button').'</i></b></span>','javascript:void(0)',array('action'=>'main','class'=>'abutton yellow noaccess', 'style'=>'margin-top:15px;'))?>
    <?php } ?>

    
</div>
    </div> 
    
    <div class="section_box"><div class="viewpop"><div class="popup_viewpop"><img src="<?php echo $this->getAssetsUrl()?>/images/tiptip_top.jpg" alt="" /></div></div>
    <b class="stl_2 icon_topup"><?php echo Yii::t('default','sms.popup.window.text.header_top');?></b><br/>
<?php echo Yii::t('default','sms.popup.window.text.header_top.desc');?> 
<div>
<?php if (!Yii::app()->user->isGuest){ ?>
    <?php echo CHtml::link('<span><b><i>'.Yii::t('default','up.button').'</i></b></span>','javascript:void(0)',array('class'=>'abutton yellow', 'style'=>'margin-top:15px;', 'id'=>'place_top'))?>
<?php } else {?>
      <?php echo CHtml::link('<span><b><i>'.Yii::t('default','up.button').'</i></b></span>','javascript:void(0)',array('action'=>'top','class'=>'abutton yellow noaccess', 'style'=>'margin-top:15px;'))?>
  
    <?php } ?>

</div>

    </div>
    
    
        <div class="section_box" style="border-bottom:0;">
<?php
echo Yii::t('default','sms.popup.window.text.free_part1');
    if (!Yii::app()->user->isGuest){
        echo Yii::t('default','sms.popup.window.text.free_part2-3');
    } else {
        echo Yii::t('default','sms.popup.window.text.free_part2-2');
    } 
echo Yii::t('default','sms.popup.window.text.free_part3');
?>
</div>

</div>
</div>

            <?php if (!Yii::app()->user->isGuest){ ?>
<script type="text/javascript">
$(function(){
      $('#place_top').click(function(){
        $('#loading_popup').css({'display':'inline'});
	$.ajax({
	    url: '/up/place_top/',
	    type:'post',
            data: {global: true},
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
            data: {global: true},
	    success:function(resultdata) {
		$('#ajax_popup').html(resultdata);
                $('#loading_popup').hide();
	    }
	});
	return false;
      });
  });
</script>

<?php }else{ ?>
<script type="text/javascript">
$(function(){
      $('.noaccess').click(function(){
        $('#loading_popup').css({'display':'inline'});
	$.ajax({
	    url: '/up/noaccess/',
	    type:'post',
            data: {action: $(this).attr('action')},
	    success:function(resultdata) {
		$('#ajax_popup').html(resultdata);
                $('#loading_popup').hide();
	    }
	});
	return false;
      });
  });
</script>


<?php } ?>
<script type="text/javascript">
$(function(){
      $('#free').click(function(){
        $('#loading_popup').css({'display':'inline'});
	$.ajax({
	    url: '/up/free/',
	    type:'post',
            data: {action: $(this).attr('action')},
	    success:function(resultdata) {
		$('#ajax_popup').html(resultdata);
                $('#loading_popup').hide();
	    }
	});
	return false;
      });
  });
</script>
