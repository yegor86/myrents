<?php
$this->pageTitle=Yii::t('default','registration');
?>
<script type="text/javascript">
$(function() {$(".flash-alert-success").fadeOut(10000);});
$(function() {$(".flash-alert-error").fadeOut(10000);});
</script>

<?php if(Yii::app()->user->hasFlash('error')):?>
<div class="flash-alert-success">
<?php echo Yii::app()->user->getFlash('error')?>
</div>
<?php endif?>


<div class="main one">

<table border="0" class="register_page" cellpadding="0" cellspacing="0" style="z-index:5;position: relative">
    <tr>
        <td width="55%" valign="top" style="border-right: 1px solid #dbdbdb">
            <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>  
<table border="0" class="table_box" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td><h2 class="title"><?php echo Yii::t('default','registration')?></h2></td>
  </tr>
  <tr>
    <td class="left"><?php echo $form->labelEx($model,'firstname'); ?></td>
    <td class="right"><div class="input_div"><?php echo $form->error($model,'firstname'); ?><?php echo $form->textField($model,'firstname'); ?><small><?php echo Yii::t('default','enter your firstname (A-Z)')?></small></div></td>
  </tr>
  <tr>
  <td class="left"><?php echo $form->labelEx($model,'lastname'); ?></td>
    <td class="right"><div class="input_div"><?php echo $form->error($model,'lastname'); ?><?php echo $form->textField($model,'lastname'); ?><small><?php echo Yii::t('default','enter your lastname (A-Z)')?></small></div></td>
  </tr>
  <tr>
    <td class="left"><?php echo $form->labelEx($model,'email'); ?></td>
    <td class="right"><div class="input_div"><?php echo $form->error($model,'email'); ?>
	<?php echo $form->textField($model,'email'); ?><small>
	    <?php echo Yii::t('default','enter email (needed by authenticatin)')?></small></div></td>
  </tr>
  <tr>
    <td class="left"><?php echo $form->labelEx($model,'password'); ?></td>
    <td class="right"><div class="input_div"><?php echo $form->error($model,'password'); ?><?php echo $form->passwordField($model,'password'); ?><small><?php echo Yii::t('default','Your password must be at least 6 characters')?></small></div></td>
  </tr>
  <tr>
    <td class="left"><?php echo $form->labelEx($model,'confirmpassword'); ?></td>
    <td class="right"><div class="input_div"><?php echo $form->error($model,'confirmpassword'); ?><?php echo $form->passwordField($model,'confirmpassword'); ?>
		</div></td>
  </tr>
  <tr>
    <td></td>
    <td class="right">
    
<?php 
    echo CHtml::link('<span><b><i>' . Yii::t('default','Create account') . '</i></b></span>','javascript:void(0)',array('onclick'=>'submitForm ("#register-form");','class'=>'abutton blue'));
?>
    
    </td>
  </tr>
</table>
<?php $this->endWidget(); ?>
            
        </td>
        <td width="45%" valign="top" style="border-left: 1px solid #fff">
        
        <table border="0" class="table_box sing" cellpadding="0" cellspacing="0">
  <tr>
    <td><h2 class="title"><?php echo Yii::t('default','Sign in using')?></h2></td>
  </tr>

  <tr>

      
      <td class="right">
	  
	  
	      <?php Yii::app()->eauth->renderWidget(array('view'=>'big')); ?>  
	  
      </td>
  </tr>

</table>
            <div class="hint" style="width:330px; padding-left: 30px;"><?php echo Yii::t('default','register page text content')?><br>
</div>
        <td>
    </tr>
</table>
</div>
