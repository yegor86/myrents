<div class="main one">
    <div class="mainhead">
        <div>
            <div>
                <div></div>
		<table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><h3 class="flt_l"><?php echo Yii::t('default','API');?></h3></td></tr></table>


            </div>
        </div>
    </div>
    <div class="content"><div class="tab_content pdd_10">

        
        <?php if($executed==$count){ 
echo '<div id="progressdiv">' . Yii::t('api','execution.complete', array('{count}'=>$count)) .'</div>';
 }else{ 
     echo '<div id="progressdiv">' . Yii::t('api','execution.progress', array('{count}'=>$count,'{executed}'=>$executed)) . '</div>';
?>
<div id="logdiv"><?php echo($error['status'].': '.$error['message']) ?><br></div>
<div id="api_load" style="display:none;"><img src="<?php echo $this->getAssetsUrl()?>/images/s-loading.gif" border="0" alt=""></div>
<script>
    
function logResult(log){
	
	var str = '<div>'+log.status+': '+log.message+'</div>';
	$('#logdiv').append(str);
	
}
    
function nextStep(){
    var countlist = <?php echo $count ?>;
    $('#api_load').show(0);
    $.ajax({
	url:document.location.href,
	type:'post',
	dataType: 'json',
	data:{},
	success:function(data){
	    var executed = data.result;
	    logResult(data.log);
	    if(executed!=countlist&&data.log.status!='Error'){
                $('#completed').html(executed);
            
		nextStep();
                
	    }else{
		$('#progressdiv').html("<?php echo Yii::t('api','execution.complete', array('{count}'=>$count))?>");
	    }
            $('#api_load').hide(0);
	},
	error:function(xhr, ajaxOptions, thrownError){
		logResult('network error');
		nextStep()
	}
    });
}

nextStep();
</script>



<?php }?>
        </div></div>
</div>