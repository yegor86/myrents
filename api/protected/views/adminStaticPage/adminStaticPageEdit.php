<div id="full_container">
    
    <?php
$bcArr = array(
    'Страницы' => '/admin/staticpage/',
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
            
            
            <table border="0" width="100%" cellpadding="4" cellspacing="0">
                <tr>
                    <td width="30%">123123</td>
                    <td width="70%">123123</td>
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
                <tr>
                    <td width="30%"><?php echo $form->label($EditForm,'alias'); ?></td>
                    <td width="70%"><?php echo $form->textField($EditForm,'alias');?><?php echo $form->error($EditForm,'alias'); ?></td>
                </tr>

            </table>
            <div style="width:800px;">


            





         <div style="clear:both"></div>   
            <?php echo CHtml::submitButton('Сохранить', array('class'=>'btn_edit b_yellow'));?>
            </div>
               <?php $this->endWidget(); ?>




            
                </td></tr></table>
</div>