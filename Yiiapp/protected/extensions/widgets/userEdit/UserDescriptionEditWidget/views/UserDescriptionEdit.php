<script type="text/javascript">$(function() {$("#descBox .flash-msg-success, #descBox .flash-msg-error").fadeOut(10000);});</script>
  <script type="text/javascript">
$(document).ready(function($){	
    $(".nametextarea").charCount({allowed: 600, warning: 50, counterText: " <?php echo Yii::t('default','символов осталось')?>"});
});

$(function() {  
    $('#desctiprionForm textarea').keyboard('ctrl+enter', function(e, bind) {
        ajaxSubmitForm("#desctiprionForm","/user/edit/UserDescriptionEdit","#descriptionEditResult","load_box_desc");
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
	    'name'=>'editdescription',
	    'class'=>'border_top',
	    'id'=>'desctiprionForm',
	    'onsubmit'=>'return false'
	)
    
)); ?>
<b class="stl_2"><?php echo Yii::t('default', 'wgt.userEdit.overview')?>:</b><br />

    <?php echo $form->error($description,'overview'); ?>
<?php echo $form->textArea($description,'overview',array('rows'=>'8','cols'=>'40','maxlength'=>'600','class'=>'nametextarea')); ?>
<div class="hint"><?php echo Yii::t('default','user.edit.description.context')?>.</div>
<span class="elem_counter"></span>
<div class="mrg_lft_30 display_in_block">
<?php 
    echo CHtml::link('<span><b><i>'.Yii::t('default', 'save').'</i></b></span>','javascript:void(0)',array('onclick'=>'ajaxSubmitForm("#desctiprionForm","/user/edit/UserDescriptionEdit","#descriptionEditResult","load_box_desc")','class'=>'abutton blue'));
    ?>
</div>
<span id="load_box_desc" style="display:none"><img src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt=""></span>
<span id="descBox">
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


				
