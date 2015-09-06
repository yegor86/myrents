<?php
$this->pageTitle=Yii::t('default','agency.creating.title');
?>
<script type="text/javascript">
$(function() {$(".flash-alert-success").fadeOut(10000);});
$(function() {$(".flash-alert-error").fadeOut(10000);});
</script>

<?php if(Yii::app()->user->hasFlash('error')):?>
<div class="flash-alert-success">
<?php echo Yii::app()->user->getFlash('error')?>
</div>
<?php endif?>


<div class="main one">

<table border="0" class="register_page" cellpadding="0" cellspacing="0" style="z-index:5;position: relative">
    <tr>
        <td width="55%" valign="top" style="border-right: 1px solid #dbdbdb">
	    <?php
	    $form = $this->beginWidget('CActiveForm', array(
		'id' => 'agency_create_form',
		'clientOptions' => array(
		    'validateOnSubmit' => true,
		),
		'htmlOptions' => array(
		    'enctype' => 'multipart/form-data',
		)
		    ));
	    ?>  
<table border="0" class="table_box" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td><h2 class="title"><?php echo Yii::t('default','agency.creating.title')?></h2></td>
  </tr>
  <tr>
    <td class="left"><?php echo $form->labelEx($model,'image'); ?></td>
    <td class="right"><div class="input_div"><?php echo $form->error($model,'image'); ?><?php echo $form->fileField($model,'image'); ?><small><?php echo Yii::t('default','agency.create.image.hint')?></small></div></td>
  </tr>
  <tr>
  <td class="left"><?php echo $form->labelEx($model,'doc'); ?></td>
    <td class="right"><div class="input_div"><?php echo $form->error($model,'doc'); ?><?php echo $form->fileField($model,'doc'); ?><small><?php echo Yii::t('default','agency.create.doc.hint')?></small></div></td>
  </tr>
  <tr>
    <td class="left"><?php echo $form->labelEx($model,'name'); ?></td>
    <td class="right"><div class="input_div"><?php echo $form->error($model,'name'); ?>
	<?php echo $form->textField($model,'name'); ?><small>
	    <?php echo Yii::t('default','agency.create.name.hint')?></small></div></td>
  </tr>
  <tr>
    <td class="left"><?php echo $form->labelEx($model,'description'); ?></td>
    <td class="right"><div class="input_div"><?php echo $form->error($model,'description'); ?><?php echo $form->textArea($model,'description'); ?><small><?php echo Yii::t('default','agency.create.description.hint')?></small></div></td>
  </tr>
  <tr>
    <td></td>
    <td class="right">
    
<?php 
    echo CHtml::link('<span><b><i>' . Yii::t('default','agency.create.button') . '</i></b></span>','javascript:void(0)',array('onclick'=>'submitForm ("#agency_create_form");','class'=>'abutton blue'));
?>
    
    </td>
  </tr>
</table>
<?php $this->endWidget(); ?>
            
        </td>
    </tr>
</table>
</div>
