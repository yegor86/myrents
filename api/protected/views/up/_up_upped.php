<div class="popup_head"><div class="goback"></div><h2><?php echo Yii::t('default','sms.popup.window.text.header_free')?> <img id="loading_popup" style="display:none" src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt="Loading"></h2></div>
<div id="popup_container" style="width:550px;padding:0 0 20px 0;height: 30px">
    
<div class="section_box" style="border:0;">
<?php echo Yii::t('default','up.sended message');?>
</div>

</div>



<script type="text/javascript">
  $(function() {  
      $('.goback').click(function(){
        $('#loading_popup').css({'display':'inline'});
	$.ajax({
	    url: '/up/<?php echo $_POST['id'];?>',
	    type:'post',
	    data:{id:'<?php echo $_POST['id'];?>'},
	    success:function(resultdata) {
		$('#ajax_popup').html(resultdata);
                $('#loading_popup').css({'display':'none'});
	    }
	});
	return false;
      });

  });
</script>

