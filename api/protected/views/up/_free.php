<div id="ajax_popup">
<div class="popup_head"><?php if(isset($_POST['global'])){?><div class="goback"></div><?php }?><h2><?php echo Yii::t('default','sms.popup.window.text.header_free')?> <img id="loading_popup" style="display:none" src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt="Loading"></h2></div>
<div id="popup_container" style="width:450px;padding:20px 60px 20px 60px;height: 280px">
    
      <?php if($this->user->getActiveUpsCount()){?>
<?php echo Yii::t('default','sms.popup.window.text.topfree')?>
    <div id="selector_rent">

<div class="trans">
<span>Выберите объявление</span>
<div class="trans_txt"></div>
<div class="clr"></div>
</div>
</div>
 
<div id="list_rents" class="hidden">
            <div class="brdr">
    	    <div class="scroll-pane">
<?php $descriptions = array();?>
                <?php if(count($rentsList)){?>
<?php foreach($rentsList as $key => $rent){?>
                <?php $descriptions[$key] = (isset($rent->descriptions[0])) ? $rent->descriptions[0] : RentDescription::model()->findByPk(array('rent' => $rent->id, 'language' => 1));
				if ($rent->todo == 3) {
				    $avatar = $this->getAssetsUrl() . '/images/buy_image.png';
				} elseif ($rent->cover)
				    $avatar = '/uploads/rentpic/' . $rent->id . '/thumbs/' . $rent->cover->file;
				elseif (($rent->photos) && ($rent->photos[0]->file)) {
				    $avatar = '/uploads/rentpic/' . $rent->id . '/thumbs/' . $rent->photos[0]->file . '';
				} else {
				    $avatar = $this->getAssetsUrl() . '/images/no_gallery_s.png';
				}
                                ?>
			<div class="scroll_box" name="<?php echo $descriptions[$key]->name?>" ids="<?php echo $rent->id?>">
			    <div class="flt_l clr">
				<span class="similar_img" style="background-image: url('<?php echo $avatar?>')"></span>
			    </div>
			    <div class="flt_l" style="margin-left:5px;"><div class="trans"><a href="javascript:void(0)" class="link3"><?php echo $descriptions[$key]->name?></a><div class="trans_txt"></div><div class="clr"></div></div>
            		<?php if ($rent->todo == 1) { ?>
	    			<div class="price" style="padding-top:20px"><b><?php echo Yii::t('default', $this->currentCurrency->short_name)?> <?php echo round($rent->$prices[$rent->current_price]['row'] / $this->currentCurrency->rate) ?></b> <?php echo Yii::t('default', $prices[$rent->current_price]['row']); ?></div>
	<?php } else { ?>
	    			<div class="price" style="padding-top:20px"><b><?php echo Yii::t('default', $this->currentCurrency->short_name)?> <?php echo round($rent->price_day / $this->currentCurrency->rate) ?></b></div>
	<?php } ?>
                                

			    </div>
			</div>
<?php } ?>
                <?php }else{ ?>
Пусто.
                <?php } ?>


    	    </div>
</div>
    </div>
    <div id="sms_box" class="none">
              <center><?php echo CHtml::link('<span><b><i>'.Yii::t('default','up.button').'</i></b></span>','javascript:void(0)',array('class'=>'free_submit abutton yellow', 'style'=>'margin-top:15px;'))?></center>
  
		      

    </div>


        <?php }else{?>
<center><b style="color:#c94718"><?php echo Yii::t('default','up.today you reached your limit');?></b></center>
        <?php }?>





</div></div>
<script>
    $(function(){
        $('#selector_rent').click(function(){
            $('#list_rents').toggleClass('hidden');
        });
        $('.scroll_box').click(function(){
            $('#selector_rent .trans span').text($(this).attr('name'));
            $('#id_board').text($(this).attr('ids'));
            $('#list_rents').toggleClass('hidden');
            $('#sms_box').removeClass('none');
            $('.free_submit').attr('href', '/up/'+$(this).attr('ids'));
            $('.free_submit').attr('confirm', 'confirm'+$(this).attr('ids'));
            $('.free_submit').attr('idd', $(this).attr('ids'));
        });
    });
    
          $('.free_submit').click(function(){
        $('#loading_popup').css({'display':'inline'});
	$.ajax({
	    url:$(this).attr('href'),
	    type:'post',
	    data:{confrmed:true, id:$(this).attr('idd')},
	    success:function(resultdata) {
		$('#ajax_popup').html(resultdata);
                $('#loading_popup').hide();
	    }
	});
	return false;
      });
    
    init_scrollpane();

</script>

