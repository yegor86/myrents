<h1>Редактирование</h1>


                    
                    
<table border="0" width="100%"><tr><td width="20%" valign="top">

        </td><td width="80%">
     
            
                        <?php $form=$this->beginWidget('CActiveForm', array(

	'clientOptions'=>array(
	'validateOnSubmit'=>true
	),
        'htmlOptions'=>array('enctype' => 'multipart/form-data')

)); ?>
            <?php echo $EditForm->image?>
<img src="/uploads/partners/<?php echo $EditForm->image?>" />
<input type="hidden" name="Partner[oldimage]" value="<?php echo $EditForm->image?>" />
            <div style="width:800px;">

<div style="clear:both"></div>
            
<div style="width:200px;float:left">
<?php echo $form->label($EditForm,'url'); ?>
    </div>
<div style="width:600px;float:right">
<?php echo $form->textField($EditForm,'url');?>
<?php echo $form->error($EditForm,'url'); ?>
</div>

<div style="clear:both"></div>
            
<div style="width:500px;float:left">
<?php echo $form->label($EditForm,'image'); ?>
    </div>
<div style="width:600px;float:right">
<?php echo $form->fileField($EditForm,'image');?>
<?php echo $form->error($EditForm,'image'); ?>
</div>
<div style="clear:both"></div>
<div id="tabs">
    <ul>
        <li><a href="#lang_1" class="ru">ru</a></li>
        <li><a href="#lang_2" class="en">en</a></li>
        <li><a href="#lang_3" class="ua">ua</a></li>
    </ul>
<?php foreach($trans as $key=>$langs){?>
    <div id="lang_<?php echo $key?>">
        
        
<div style="width:200px;float:left">
<?php echo $form->label($langs,"[$key]name"); ?>
</div>
<div style="width:600px;float:right">
<?php echo $form->textField($langs,"[$key]name");?>
<?php echo $form->error($langs,"[$key]name"); ?>
</div>
<div style="clear:both"></div>

<div style="width:200px;float:left">
<?php echo $form->label($langs,"[$key]description"); ?>
</div>
<div style="width:600px;float:right">
<?php echo $form->textArea($langs,"[$key]description");?>
<?php echo $form->error($langs,"[$key]description"); ?>
</div>
<div style="clear:both"></div>

</div>
<?php }?>
   
</div>


 
            <?php echo CHtml::submitButton('Сохранить', array('class'=>'btn_edit b_yellow'));?>
            </div>
               <?php $this->endWidget(); ?>




            
                </td></tr></table>

