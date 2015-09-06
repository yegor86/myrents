<div id="full_container">
    
    <?php
$bcArr = array(
    'Страницы' => '/admin/staticpage/',
    'Добавление',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'homeLink'=>CHtml::link('Главная','/admin/'),
    'links'=>$bcArr
)); 
 ?>

                    
                    
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0"><tr><td width="100%" valign="top" class="center_container">
            <h2>Добавление</h2>
     
            
                        <?php $form=$this->beginWidget('CActiveForm', array(

	'clientOptions'=>array(
	'validateOnSubmit'=>true
	),
        'htmlOptions'=>array('enctype' => 'multipart/form-data')

)); ?>
            
            
            <table border="0" width="100%" cellpadding="4" cellspacing="0">
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

        
                        <table border="0" width="100%" cellpadding="3" cellspacing="2">
                    <tr>
                        <td width="29%" align="right"><?php echo $form->label($langs,"[$key]name"); ?></td>
                        <td width="71%"><?php echo $form->textField($langs,"[$key]name");?><?php echo $form->error($langs,"[$key]name"); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><?php echo $form->label($langs,"[$key]description"); ?></td>
                        <td><?php echo $form->textArea($langs,"[$key]description");?><?php echo $form->error($langs,"[$key]description"); ?></td>
                    </tr>
                </table>
        
        

</div>
<?php }?>
   
</div>
                        
                    </td>
                <tr>
                    <td width="30%"><?php echo $form->label($EditForm,'alias'); ?></td>
                    <td width="70%"><?php echo $form->textField($EditForm,'alias');?><?php echo $form->error($EditForm,'alias'); ?></td>
                </tr>

            </table>
  
            <?php echo CHtml::submitButton('Сохранить', array('class'=>'btn_edit b_green'));?>

               <?php $this->endWidget(); ?>




            
                </td></tr></table>
</div>