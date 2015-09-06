<?php

$this->pageTitle = Yii::t('default', 'need.help');

?>


<img style="display: none" src="<?php echo $this->assetsUrl ?>/images/map-indi.png" id="flat_indicator">

<div class="main one">
    <div class="mainhead">
	<div>
	    <div>
		<div></div>
		<table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><?php echo Yii::t('default', 'need.help') ?>
		
                        </td><td><a href="/search/" class="search_btn flt_r popEdge" title="<?php echo Yii::t('default', 'search.button'); ?>"></a></td></tr></table>
	    </div>
	</div>
    </div>
    <div class="content">


        
        
        
        
        
        
        
        
<div id="support_box_popup" style="border:0;margin-left: 120px;">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
	'id' => 'supportForm',
	'clientOptions' => array(
	    'validateOnSubmit' => true,
	),
	'htmlOptions' => array('name' => 'supportForm'),
	    ));
    ?>      

    <table border="0" width="100%" cellpadding="0" cellspacing="0" style="padding:0 50px;">
	<tr>
	    <td width="100%">
		<div class="stl_2"><?php echo $form->label($supportForm, 'name'); ?>:</div>
		<div class="inp"><?php echo $form->textField($supportForm, 'name'); ?>
		
		</div>
	    </td>
	</tr>
	<tr>

	    <td width="100%"><div class="stl_2"><?php echo $form->label($supportForm, 'email'); ?>:</div>
		<div class="inp"><?php echo $form->textField($supportForm, 'email'); ?>
		</div></td>
	</tr>
	<tr>
	    <td width="100%"><div class="stl_2"><?php echo $form->label($supportForm, 'description'); ?>:</div>
		<div class="texta"><?php echo $form->textArea($supportForm, 'description' ,array('rows'=>5)); ?>
		
		</div></td>

	</tr>
	<tr>
	    <td width="100%"><div style="padding-top:10px;">
<?php 
    echo CHtml::link('<span><b><i>'.Yii::t('default','send').'</i></b></span>','javascript:void(0)',array('onclick'=>'ajaxSubmitForm("#supportForm","/support","#support_box_popup")','class'=>'btn_border abutton yellow'));
    ?>

		</div></td>

	</tr>

    </table>
    <?php $this->endWidget(); ?>


</div>
        
        
        
        
        
        
        

    </div>
    
</div>

