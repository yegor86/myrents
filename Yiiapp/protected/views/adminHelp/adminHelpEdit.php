<h1>add</h1>


                    
                    
<table border="0" width="100%"><tr><td width="20%" valign="top">

        </td><td width="80%">
     
            
                        <?php $form=$this->beginWidget('CActiveForm', array(

	'clientOptions'=>array(
	'validateOnSubmit'=>true
	),
        'htmlOptions'=>array('enctype' => 'multipart/form-data')

)); ?>
            
            <div style="width:800px;">

<div style="clear:both"></div>
            
<div style="width:200px;float:left">
<?php echo $form->label($EditForm,'alias'); ?>
    </div>
<div style="width:300px;float:right">
<?php echo $form->textField($EditForm,'alias');?>
<?php echo $form->error($EditForm,'alias'); ?>
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


         <div style="clear:both"></div>   
            <?php echo CHtml::submitButton('Сохранить', array('class'=>'btn_edit b_yellow'));?>
            </div>
               <?php $this->endWidget(); ?>




            
                </td></tr></table>
