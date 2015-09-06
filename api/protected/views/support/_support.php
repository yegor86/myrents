    <?php
    $form = $this->beginWidget('CActiveForm', array(
	'id' => 'supportForm',
	'clientOptions' => array(
	    'validateOnSubmit' => true,
	),
	'htmlOptions' => array('name' => 'supportForm'),
	    ));
    ?>      

    <table border="0" width="100%" cellpadding="0" cellspacing="0">
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
