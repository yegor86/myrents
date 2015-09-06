

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
    $('#loading_popup').css({'display':'inline'});
    $.ajax({
        url: '/up/global/',
        type:'post',
        data:{global: true},
        success:function(resultdata) {
            $('#ajax_popup').html(resultdata);
            $('#loading_popup').hide();
        }
    });
        return false;
    });
    </script>






<div id="ajax_popup">
<div class="popup_head"><div class="goback"></div><h2><?php echo Yii::t('default','sms.popup.window.text.header_main')?> <img id="loading_popup" style="display:none" src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt="Loading"></h2></div>
<div id="popup_container" style="padding:20px 60px 20px 60px;height: 180px">
<?php echo Yii::t('default','sms.popup.window.text.topmain')?>

    <br/><br/>
    <center>
<a class=" btn_border abutton blue" href="/rent/list">
<span>
<b>
<i><?php echo Yii::app('default','registration')?></i>
</b>
</span>
</a>
    </center>


<div id="sms_box">
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

</div>
</div>
</div>


