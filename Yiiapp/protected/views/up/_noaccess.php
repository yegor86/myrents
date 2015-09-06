<?php if(isset($_POST)){
    if($_POST['action']=='top'){
    $popup_title = Yii::t('default','sms.popup.window.text.header_top');
    $popup_text = Yii::t('default','sms.popup.window.text.top');
    $popup_time = Yii::t('default','sms.popup.window.time.top');
    $popup_param = Yii::app()->params['smsTopPeriods'];
     }elseif($_POST['action']=='main'){
    $popup_title = Yii::t('default','sms.popup.window.text.header_main');
    $popup_text = Yii::t('default','sms.popup.window.text.topmain');
    $popup_time = Yii::t('default','sms.popup.window.time.main');
    $popup_param = Yii::app()->params['smsMainPeriods'];
     }else{
    $popup_title = Yii::t('default','sms.popup.window.text.header_free');
    $popup_text = Yii::t('default','sms.popup.window.text.free.desc');

     }
    }
?>
<div class="popup_head"><div class="goback"></div><h2><?php echo $popup_title; ?> <img id="loading_popup" style="display:none" src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt="Loading"></h2></div>
<div id="popup_container" style="padding:20px 60px 20px 60px;height: 240px">
<span style="line-height: 18px;"><?php echo $popup_text; ?></span>

    <br/><br/>
    <center>
<a class=" btn_border abutton blue" href="/rent/list">
<span>
<b>
<i><?php echo Yii::t('default','registration')?></i>
</b>
</span>
</a>
    </center>

<?php if($_POST['action']!='free'){?>
<div id="sms_box">

<table border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="70%"><small><?php echo $popup_time?>:</small></td>
        <td width="30%" align="right">
            
            <?php $smstop=array_keys($popup_param); ?>
            	<div id="season">
	<?php foreach ($popup_param as  $key=>$period){?>
	
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

            <div id="count_price" class="numerical"><?php echo $popup_param[$smstop[0]]['price']?></div>
        </td>
    </tr>
</table>
<br/>

</div>
    <?php }?>
</div>
<script type="text/javascript">
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