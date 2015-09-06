		    
<?php $form=$this->beginWidget('CActiveForm', array(
	
                    'id'=>'fs_sing_in_form',
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
            
	),
)); ?>

<div class="input_div">
     		<div><?php echo $form->labelEx($user,'email'); ?></div>
		<?php echo $form->error($user,'email'); ?>
		<?php echo $form->textField($user,'email'); ?>
</div>
<div class="pdd_5"></div>
<div class="input_div">
		<div><?php echo $form->labelEx($user,'password'); ?></div>
		<?php echo $form->error($user,'password'); ?>
		<?php echo $form->passwordField($user,'password'); ?>
</div>
<div class="pdd_5"></div>
<p><?php echo Yii::t('default','Sign in using')?></p>
		<?php Yii::app()->eauth->renderWidget(); ?>
<!--<a class="flt_l" href=""><img src="images/sing_fb.gif" border="0" alt="" /></a>
<a class="flt_r" href=""><img src="images/sing_vk.gif" border="0" alt="" /></a>
-->
<div class="clr"></div>
<div class="pdd_5"></div>
<?php if($this->enableRememberMe): ?>
<?php echo CHtml::activeCheckBox($user,'rememberMe'); ?> <?php echo $form->labelEx($user,'rememberMe', array('class'=>'lab_checkbox')); ?><br />
<?php endif; ?>
<a class="link4" href="/remind" style="display: inline "><?php echo Yii::t('default','forgot.passwd')?>?</a>
<div class="sing_in_btn">
    <?php 
    echo CHtml::link('<span id="btn_sing_id"><b><i>'.Yii::t('default','to.enter').'</i></b></span>','javascript:void(0)',array('onclick'=>'ajaxSubmitForm ("#fs_sing_in_form", "/wlogin", ".sing_in_block");','class'=>'btn_border abutton blue'));
    ?>
</div>
<?php $this->endWidget(); ?>
