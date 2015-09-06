<script type="text/javascript">$(function() {$("#skypeBox .flash-msg-success, #skypeBox .flash-msg-error").fadeOut(10000);});</script>
<script type="text/javascript">
$(function() {  
    $('#SkypeForm input').keyboard('enter', function(e, bind) {
        ajaxSubmitForm("#SkypeForm","/user/edit/SkypeEdit","#SkypeEditResult", "load_box_skype");
        return false;
    });
});
</script>

<?php $form=$this->beginWidget('CActiveForm', array(
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	),
	'htmlOptions'=>array(
	    'name'=>'editdeskype',
	    'class'=>'border_top',
	    'id'=>'SkypeForm',
	    'onsubmit'=>'return false'
	    
	)
    
)); ?>
<b class="stl_2"><?php echo  Yii::t('default','wgt.userEdit.skype')?>:</b><br />

    <?php echo $form->error($skype,'skype'); ?>
<?php echo $form->textField($skype,'skype',array()); ?><br /><br />
<div class="mrg_lft_30 display_in_block">
<?php 
    echo CHtml::link('<span><b><i>'.Yii::t('default', 'save').'</i></b></span>','javascript:void(0)',array('onclick'=>'ajaxSubmitForm("#SkypeForm","/user/edit/SkypeEdit","#SkypeEditResult", "load_box_skype")','class'=>'abutton blue'));
    ?>
</div>
<span id="load_box_skype" style="display:none"><img src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt=""></span>

    <span id="skypeBox">
<?php if(Yii::app()->user->hasFlash('error')):?>
<span class="flash-msg-error">
<?php echo Yii::app()->user->getFlash('error')?>
</span>
<?php endif?>
<?php if(Yii::app()->user->hasFlash('success')):?>
<span class="flash-msg-success">
<?php echo Yii::app()->user->getFlash('success')?>
</span>
 <?php endif ?>
    </span>
<?php $this->endWidget(); ?>



				
