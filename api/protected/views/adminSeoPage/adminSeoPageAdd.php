<div id="full_container"><?php
$bcArr = array(
    'SEO поиска'=>'/admin/seopage/',
    'Добавление'

);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'homeLink' => CHtml::link('Главная', '/admin/'),
    'links' => $bcArr
));
?>
    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td valign="top" class="center_container"><h1>Добавление</h1>

            
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'editnews',
	'clientOptions'=>array(
	'validateOnSubmit'=>true
	),
        'htmlOptions'=>array('enctype' => 'multipart/form-data')
)); 
                       
?>
                <table border="0" width="100%" cellpadding="3" cellspacing="2">
                    <tr>
                        <td  align="right"><?php echo $form->labelEx($seoPage, 'url'); ?></td>
                        <td><?php echo $form->textField($seoPage,'url');?><?php echo $form->error($seoPage,'url'); ?></td>
                    </tr>
                                        <tr>
                        <td  align="right"><?php echo $form->labelEx($seoPage, 'content'); ?></td>
                        <td><?php echo $form->textArea($seoPage,'content');?><?php echo $form->error($seoPage,'content'); ?></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td><?php echo CHtml::submitButton('Сохранить', array('id'=>'button', 'class'=>'b_green')); ?></td>
                    </tr>
                </table>

               <?php $this->endWidget(); ?>

        </td>
    </tr>
</table>
</div>











                        <?php $form=$this->beginWidget('CActiveForm', array(

	'clientOptions'=>array(
	'validateOnSubmit'=>true
	),
        'htmlOptions'=>array('enctype' => 'multipart/form-data')

)); ?>
            

<?php echo $form->label($seoPage,'url'); ?>
<?php echo $form->textField($seoPage,'url');?>
<?php echo $form->error($seoPage,'url'); ?>         

<?php echo $form->label($seoPage,'content'); ?>
<?php echo $form->textArea($seoPage,'content');?>
<?php echo $form->error($seoPage,'content'); ?>



            <?php echo CHtml::submitButton('Сохранить', array('class'=>'btn_edit b_yellow'));?>

               <?php $this->endWidget(); ?>