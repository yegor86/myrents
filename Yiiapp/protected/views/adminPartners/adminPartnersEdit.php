<div id="full_container">
    
    <?php
$bcArr = array(
    'Партнеры' => '/admin/partners/',
    'Редактирование',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'homeLink'=>CHtml::link('Главная','/admin/'),
    'links'=>$bcArr
)); 
 ?>

                    
                    
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0"><tr><td width="100%" valign="top" class="center_container">
            <h2>Редактирование</h2>
     
<?php $form=$this->beginWidget('CActiveForm', array(

	'clientOptions'=>array(
	'validateOnSubmit'=>true
	),
        'htmlOptions'=>array('enctype' => 'multipart/form-data')

)); ?>
             <?php echo $EditForm->image?>
<img src="/uploads/partners/<?php echo $EditForm->image?>" />
<input type="hidden" name="Partner[oldimage]" value="<?php echo $EditForm->image?>" />           
            
            <table border="0" width="100%" cellpadding="4" cellspacing="0">
                <tr>
                    <td width="30%"><?php echo $form->label($EditForm,'url'); ?></td>
                    <td width="70%"><?php echo $form->textField($EditForm,'url');?><?php echo $form->error($EditForm,'url'); ?></td>
                </tr>
                <tr>
                    <td width="30%"><?php echo $form->label($EditForm,'image'); ?></td>
                    <td width="70%"><?php echo $form->fileField($EditForm,'image');?><?php echo $form->error($EditForm,'image'); ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div id="tabs">
    <ul>
        <li><a href="#lang_1" class="ru">Русский</a></li>
        <li><a href="#lang_2" class="en">English</a></li>
        <li><a href="#lang_3" class="ua">Український</a></li>
    </ul>
<?php foreach($trans as $key=>$langs){?>
    <div id="lang_<?php echo $key?>">
        
        
<div style="width:200px;float:left">
<?php echo $form->label($langs,"[$key]name"); ?>
</div>
<div style="width:800px;float:right">
<?php echo $form->textField($langs,"[$key]name");?>
<?php echo $form->error($langs,"[$key]name"); ?>
</div>
<div style="clear:both"></div>

<div style="width:200px;float:left">
<?php echo $form->label($langs,"[$key]description"); ?>
</div>
<div style="width:800px;float:right">
<?php echo $form->textArea($langs,"[$key]description");?>
<?php echo $form->error($langs,"[$key]description"); ?>
</div>
<div style="clear:both"></div>

</div>
<?php }?>
   
</div>
                        
                    </td>
                </tr>

            </table>
            <div style="width:800px;">
   
            <?php echo CHtml::submitButton('Сохранить', array('class'=>'btn_edit b_yellow'));?>
            </div>
               <?php $this->endWidget(); ?>




            
                </td></tr></table>
</div>
