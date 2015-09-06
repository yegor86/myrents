
<?php
$this->pageTitle=Yii::t('default','registration');
?>

<div class="main one">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>  
<table border="0" class="register_page" cellpadding="0" cellspacing="0" style="z-index:5;position: relative">
    <tr>
        <td width="55%" valign="top" style="border-right: 1px solid #dbdbdb">
            
<table border="0" class="table_box" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td><h2 class="title"><?php echo Yii::t('default','registration')?></h2></td>
  </tr>
  <tr>
    <td class="left"><?php echo $form->labelEx($model,'firstname'); ?></td>
    <td class="right"><div class="input_div"><?php echo $form->error($model,'firstname'); ?><?php echo $form->textField($model,'firstname'); ?><small><?php echo $form->labelEx($model,'input text (A-Z)'); ?></small></div></td>
  </tr>
  <tr>
  <td class="left"><?php echo $form->labelEx($model,'lastname'); ?></td>
    <td class="right"><div class="input_div"><?php echo $form->error($model,'lastname'); ?><?php echo $form->textField($model,'lastname'); ?><small><?php echo $form->labelEx($model,'input text (A-Z)'); ?></small></div></td>
  </tr>
  <tr>
    <td class="left"><?php echo $form->labelEx($model,'email'); ?></td>
    <td class="right"><div class="input_div"><?php echo $form->error($model,'email'); ?><?php echo $form->textField($model,'email'); ?></div></td>
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
    <td class="right"><ul><li><a href="/login/vkontakte" class="vk"></a></li><li><a href="/login/facebook" class="fb"></a></li></ud></td>
  </tr>

</table>
            <div class="hint" style="width:300px; padding-left: 30px;"><?php echo Yii::t('default', 'mesage to user about difference of VK, FB and local accounts')?></div>
        <td>
    </tr>
</table>















