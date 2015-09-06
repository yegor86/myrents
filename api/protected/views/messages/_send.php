
<script type="text/javascript">
$(function() {$(".flash-alert-success").fadeOut(10000);});
$(function() {$(".flash-alert-error").fadeOut(10000);});
</script>
<?php if(Yii::app()->user->hasFlash('error')):?>
<div class="flash-alert-error">
<?php echo Yii::app()->user->getFlash('error')?>
</div>
<?php endif?>
<?php if(Yii::app()->user->hasFlash('success')):?>
<div class="flash-alert-success">
<?php echo Yii::app()->user->getFlash('success')?>
</div>
<?php endif?>

<div class="message_box" style="border:0">
        <div class="post stl_2" style="padding:0 10px;cursor: default"><?php echo Yii::t('messages','message.to_user');?>
		<?php echo CHtml::link($receiver->firstname . ' ' . $receiver->lastname, '/user/' . $receiver->id, array('class' => 'link')) ?>
    
        </div>

    </div>
    <div class="addcomment" style="margin-top: 0;">
<?php
	$form = $this->beginWidget('CActiveForm', array(
	    'id' => 'send_message_form',
	    'enableAjaxValidation' => false,
	    'htmlOptions' => array('name' => 'add_comment')
		));
	?>

	
    <?php echo $form->error($message, 'message'); ?>
        
	    <?php echo $form->textArea($message, 'message', array('rows' => 40, 'cols' => 40, 'class' => 'comm_textarea', 'style'=>'width:920px;')); ?>
	        
    <div class="pdd_5"></div>


        <div class="flt_r" style="margin-right: 20px;margin-bottom: 20px;">

    <div class=" formdesc" style="text-align:right;"><?php echo Yii::t('default', 'enter or shift+enter') ?><div class="pdd_5"></div></div>
<span id="load_box" style="display:none"><img src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt=""></span> <?php
    echo CHtml::link('<span><b><i>' . Yii::t('default', 'Send message') . '</i></b></span>', 'javascript:void(0)', array(
	'class' => 'btn_border abutton yellow',
	'onClick' => 'ajaxSubmitForm("#send_message_form","/user/'.$this->user->id.'/messages/send/'. $receiver->id . '", "#subcontent", "#load_box");'
    ))
    ?>
     <?php $this->endWidget(); ?></div>
    <div class="clr"></div>
    </div>


    