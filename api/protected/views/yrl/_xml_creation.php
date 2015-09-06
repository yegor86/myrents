выполнено <?php echo $offset ?> из <?php echo $count ?>
<form method="POST">
    <input type="hidden" value="<?php echo $offset ?>" name="start">
</form>
<script>
    $.ajax({
	type:'post',
	url:'<?php echo Yii::app()->request->requestUri ?>',
	data:({
	    start:<?php echo $offset ?>
	}),
	success:function(data){
	    $("#creation").html(data);
	}
    })
</script>