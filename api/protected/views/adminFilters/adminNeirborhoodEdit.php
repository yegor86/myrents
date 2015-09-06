<h1>Редактирование удобства</h1>


                    
                    
<table border="0" width="100%"><tr><td width="20%" valign="top">
<?php require 'leftmenu.php';?>
        </td><td width="80%">
     
            
                        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'editneirborhood',
	'clientOptions'=>array(
	'validateOnSubmit'=>true
	),
        'htmlOptions'=>array('name'=>'editneirborhood')
)); ?>
            
            <div style="width:600px;">

<div style="clear:both"></div>
            
<div style="width:300px;float:left">
<?php echo $form->label($EditForm, 'name'); ?>
    </div>
<div style="width:300px;float:right">
<?php echo $form->textField($EditForm,'name');?> <?php echo Yii::t('default',$neirborhood->name);?>
<?php echo $form->error($EditForm,'name'); ?>
</div>


         <div style="clear:both"></div>   
            <?php echo CHtml::submitButton('Сохранить', array('class'=>'btn_edit b_yellow'));?>
            </div>
               <?php $this->endWidget(); ?>




            
                </td></tr></table>
