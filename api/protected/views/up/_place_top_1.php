<script>
    
    function smsTop(tthis, price, phone){
            $(function(){
            $('#season div a').removeClass('active');
            $('#count_price').text(price);
            $('#smstop_phone').text(phone);
            $(tthis).addClass('active');
            });
    }
        $('.goback').click(function(){
    $('#loading_up').css({'display':'inline'});
    $.ajax({
        url: '/up/global/',
        type:'post',
        data:{global: true},
        success:function(resultdata) {
            $('#ajax_popup').html(resultdata);
            $('#loading_up, #load_ups').css({'display':'none'});
        }
    });
        return false;
    });
    </script>



<script>
    $(function(){
        $('#selector_rent').click(function(){
            $('#list_rents').toggleClass('hidden');
        });
        $('.scroll_box').click(function(){
            $('#selector_rent .trans span').text($(this).attr('name'));
            $('#list_rents').toggleClass('hidden');
            $('#id_board').text($(this).attr('ids'));
            $('#sms_box').removeClass('none');
        });
    });
    
    
    
    init_scrollpane();

</script>


<div id="ajax_popup">
<div class="popup_head"><?php if(isset($_POST['global'])){?><div class="goback"></div><?php }?><h2><?php echo Yii::t('default','sms.popup.window.text.header_main')?></h2></div>
<div id="popup_container" style="width:450px;padding:20px 60px 20px 60px;height: 390px">
<?php echo Yii::t('default','sms.popup.window.text.topmain')?>

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
<table border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="70%"><small><?php echo Yii::t('default','sms.popup.window.text.season')?>:</small></td>
        <td width="30%" align="right">
            
            <?php $smstop=array_keys(Yii::app()->params['smsTopPeriods']); ?>
            	<div id="season">
	<?php foreach (Yii::app()->params['smsTopPeriods'] as  $key=>$period){?>
	
		    <div><a href="javascript:void(0)" onclick="smsTop(this, '<?php echo($period['price'])?>','<?php echo $key?>');"  id="a<?php echo $key ?>"><?php echo Yii::t('default', $period['name']) ?></a></div>
			<?php }?>
		    <script>
		document.getElementById('a<?php  echo $smstop[0]; ?>').className = "active";
		    </script>
		</div>
            
        </td>
    </tr>
    <tr>
        <td><small><?php echo Yii::t('default','sms.popup.window.text.cost_service')?></small></td>
        <td align="right">

            <div id="count_price" class="numerical"><?php echo(Yii::app()->params['smsTopPeriods'][$smstop[0]]['price'])?></div>
        </td>
    </tr>
</table>
<br/>
<b><?php echo Yii::t('default','sms.popup.window.text.send_phone')?></b>
<br/><br/>


<table border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td valign="top"><small>Отправте код:</small><span class="numerical" ><?php echo Yii::app()->params['smsbillmainprefix'].Yii::app()->params['smsbillMRprefix'].'+<span id="id_board"></span>'.Yii::app()->params['billingActions'][0].''  ;?></span></td>

        <td valign="top" align="right"><small><?php echo Yii::t('default','sms.popup.window.text.smallnum')?>:</small><span id="smstop_phone" class="numerical"><?php echo $smstop[0]?></span></td>
    </tr>
</table>



    <br/>

<div style="border-top:1px solid #D6D6D6">
    <br/>
<small style="color:#b4b4b3">Тариф в гривнах с учетом НДС. Дополнительно удерживается сбор в Пенсионный фонд в размере 7,5% от стоимости услуги без учета НДС.
Сервис только для совершеннолетних абонентов всех национальных GSM операторов;
Для получения услуги необходимо отправить 1 SMS.</small>
<br/>
<small style="color:#b4b4b3">Услуги предоставляет компания «СМС Биллинг Украина»;
Юр. адрес: 65123, Украина, г. Одесса, ул. Высоцкого, 36;
<a href="http://helpsms.info">Техническая поддержка</a> абонентов с 10:00 до 18:00 в будние дни Тел.:+380487711236;</small>
</div>
</div>
</div>
</div>



