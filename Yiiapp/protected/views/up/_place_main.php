<script>

    function smsTop(tthis, price, phone){
            $(function(){
            $('#season div a').removeClass('active');
            $('#count_price').text(price);
            $('#smstop_phone').text(phone);
            $(tthis).addClass('active');
            });
    }
    </script>

<script type="text/javascript">
  $(function() {  




      $('#place_top').click(function(){
        $('#loading_popup').css({'display':'inline'});

	$.ajax({
	    url: '/up/place_top/',
	    type:'post',
	    data:{id:'<?php echo isset($_POST['id']);?>'},
	    success:function(resultdata) {

		$('#ajax_popup').html(resultdata);
                $('#loading_popup').css({'display':'none'});
	    }
	});
	return false;
      });
      
$('.goback').click(function(){
    $('#loading_popup').css({'display':'inline'});
    $.ajax({
        url: '/up/<?php echo $_POST['id']; ?>/',
        type:'post',
        data:{id:'<?php echo $_POST['id']; ?>'},
        success:function(resultdata) {
            $('#ajax_popup').html(resultdata);
            $('#loading_popup').css({'display':'none'});
        }
    });
        return false;
    });
});
</script>

<div class="popup_head"><div class="goback"></div><h2><?php echo Yii::t('default','sms.popup.window.text.header_main')?></h2></div>
<div id="popup_container" style="width:450px;padding:20px 60px 20px 60px;height: 420px">
    <span style="line-height: 18px;"><?php echo Yii::t('default','sms.popup.window.text.topmain')?></span>

    <div id="selector_rent" style="background-image:none;cursor: default">

<div class="trans">
<span><?php echo $rent->description->name?></span>
<div class="trans_txt"></div>
<div class="clr"></div>
</div>
</div>




<div id="sms_box">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="70%"><small><?php echo Yii::t('default','sms.popup.window.time.main')?>:</small></td>
        <td width="30%" align="right">
            
            <?php $smstop=array_keys(Yii::app()->params['smsMainPeriods']); ?>
            	<div id="season">
	<?php foreach (Yii::app()->params['smsMainPeriods'] as  $key=>$period){?>
	
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

            <div id="count_price" class="numerical"><?php echo(Yii::app()->params['smsMainPeriods'][$smstop[0]]['price'])?></div>
        </td>
    </tr>
</table>
<br/>
<b><?php echo Yii::t('default','sms.popup.window.text.send_phone')?></b>
<br/><br/>


<table border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td valign="top"><small><?php echo Yii::t('default','sms.popup.window.text.send_code')?>:</small><span class="numerical" ><?php echo Yii::app()->params['smsbillmainprefix'].Yii::app()->params['smsbillMRprefix'].'+<span id="id_board">'.$_POST['id'].'</span>'.Yii::app()->params['billingActions'][1].''  ;?></span></td>

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


