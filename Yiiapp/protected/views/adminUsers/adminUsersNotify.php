
<table border="0" width="100%" width="100%" cellpadding="0" cellspacing="0"><tr><td width="20%" valign="top" class="left_container">
<?php require 'leftmenu.php';?>
        </td><td width="80%" class="right_container">
           <h2>Уведомление пользователю</h2>
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'editrent',
	'clientOptions'=>array(
	'validateOnSubmit'=>true
	),
        'htmlOptions'=>array('name'=>'sendNotify')
)); ?>

    <?php  echo $form->labelEx($notifyForm,'user'); ?>
         <?php  echo $form->error($notifyForm,'user'); ?>
        <?php echo $form->dropDownList($notifyForm,'user',$users);?> 
<br>
    <?php  echo $form->labelEx($notifyForm,'message'); ?>
         <?php  echo $form->error($notifyForm,'message'); ?>
        <?php echo $form->textArea($notifyForm,'message');?> 
<br>            
            <?php echo CHtml::submitButton('Notify');?>
            
               <?php $this->endWidget(); ?>
</table>

            
                </td></tr></table>
