<script type="text/javascript">$(function() {$("#phoneBox .flash-msg-success, #phoneBox .flash-msg-error").fadeOut(10000);});</script>
<script type="text/javascript">
$(function() {  
    $('#PhonesForm input').keyboard('enter', function(e, bind) {
        ajaxSubmitForm("#PhonesForm","/user/edit/PhonesEditor","#PhonesEditResult", "load_box_phone");
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
	    'name'=>'editphone',
	    'class'=>'border_top',
	    'id'=>'PhonesForm',
	    'onsubmit'=>'return false'
	)
    
)); ?>
<b class="stl_2"><?php echo Yii::t('default','wgt.userEdit.phones')?>:</b>
<div style="margin-bottom: -10px">
<?php foreach ($phones as $key=>$phone){?>
<div style="margin-bottom: 15px;padding-left: 14px">
    <?php echo $form->error($phone,'phone'); ?>
<b class="stl_5"></b><?php echo $form->textField($phone,'['.$key.']phone',array('class'=>'phone_profile_edit', 'style'=>'margin-left:5px;')); ?>
</div>
<?php }?>
    </div>
<div class="hint"><?php echo Yii::t('default','example')?>: <?php echo Yii::t('default', '+38 (048) 458-59-56')?></div><br />
<div class="mrg_lft_30 display_in_block">
<?php 
    echo CHtml::link('<span><b><i>'.Yii::t('default', 'save').'</i></b></span>','javascript:void(0)',array('onclick'=>'ajaxSubmitForm("#PhonesForm","/user/edit/PhonesEditor","#PhonesEditResult", "load_box_phone")','class'=>'abutton blue'));
    ?>
</div>
<span id="load_box_phone" style="display:none"><img src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt=""></span>
<span id="phoneBox">
<?php if(Yii::app()->user->hasFlash('error')):?>
<span class="flash-msg-error">
<?php echo Yii::app()->user->getFlash('error')?>
</span>
<?php endif?>
<?php if(Yii::app()->user->hasFlash('success')):?>
<span class="flash-msg-success">
<?php echo Yii::app()->user->getFlash('success')?>
</span>
 <?php endif ?></span>
<?php $this->endWidget(); ?>
