<?php 
$this->pageTitle=Yii::t('default','add bill');
?>

<script type="text/javascript">
$(function() {$(".flash-alert-error").fadeOut(8000);});
<!--
jQuery(document).ready(function(){

    var params = {
            changedEl: "#Rent_floor",
            visRows: 5,
            scrollArrows: true
    }
    cuSel(params);
});
-->



</script>


<div class="main one">
    <div class="mainhead">
      <div>
        <div>
          <div></div>
          <table border="0" cellpadding="0" cellspacing="0"><tr><td valign="middle"><?php echo Yii::t('default','add bill')?></td></tr></table>
        </div>
      </div>
    </div>
    <div class="content">

      <div class="tab_content">
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td class="controller_left_side" valign="top">
            <ul class="controller_menu">
                <li class="active"><a href="#" onclick="return false"><?php echo Yii::t('default','edit bill menu overview')?></a></li>
              </ul>
            </td>
            <td class="controller_right_side" valign="top">
                <div class="controller_edit" id="returnform">
                    <div style="height:30px;"><div class="pdd_30">
<?php if(Yii::app()->user->hasFlash('error')):?>
<div class="flash-alert-error">
<?php echo Yii::app()->user->getFlash('error')?>
</div>
<?php endif?>
                        </div></div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'createrent',
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	),
        'htmlOptions'=>array('name'=>'createrent')
)); ?>

<script type="text/javascript">
jQuery(function($){
	$.imageTick.logging = true;
	$(".imageTickType").imageTick({
		tick_image_path: "images/button.png", 
		no_tick_image_path: "images/no_buttom.gif",
		image_tick_class: "radios_type",
		custom_button: function($label){
		    $label.hide();
		    return '<div><span>' + $label.text() + '</span></div>';
		}
        });
        $(".imageTickTodo").imageTick({
                tick_image_path: "images/button.png", 
		no_tick_image_path: "images/no_buttom.gif",
		image_tick_class: "radios_todo",
		custom_button: function($label){
		    $label.hide();
		    return '<div><span>' + $label.text() + '</span></div>';
		}
	});
        
        $(".checkroom, .checkfloor").imageTick({
		image_tick_class: "checknum",
		custom_button: function($label){
		    $label.hide();
		    return '<span>' + $label.text() + '</span>';
		}
	});
 

});
</script>

  <div class="pdd_30">



<div class="panix">
<div class="stl_2"><?php echo Yii::t('default','bill action')?>:</div>
<ul class="collector" style="width: 165px;display:block">
<li>
<?php echo $form->radioButtonList($Rent,'todo',$Todo,array('separator'=>'</li><li>','class'=>'imageTickTodo')); ?>
</li>
</ul>
</div>
      
<div class="panix">
<div class="stl_2"><?php echo Yii::t('default','bill type')?>:</div>
<ul class="collector">
<li>
<?php echo $form->radioButtonList($Rent,'type',$Types,array('separator'=>'</li><li>','class'=>'imageTickType')); ?>
</li>
</ul>
</div>
<div class="clr"></div>

<table border="0" width="600" cellpadding="0" cellspacing="0">
    <tr>
       <td width="220" valign="top"><div class="stl_2"><?php echo Yii::t('default','bill rooms count')?>:</div>
           <div class="num_rooms_box" style="margin-left:20px">
               <?php echo $form->radioButtonList($Rent,'rooms_count',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5+'),array('separator'=>'','class'=>'checkroom')); ?>
        <div class="clr"></div>
</div>
       </td> 
       <td width="170" valign="top"><div class="stl_2"><?php echo Yii::t('default','bill floor')?>:</div><br />

			       <?php echo $form->dropDownList($Rent,'floor',Yii::app()->params['floors_to_edit'], array('style'=>'width: 83px;'));?>

       </td>
       
       
       
       <td width="150" valign="top"><div class="stl_2"><?php echo Yii::t('default','bill square')?> (m<sub>2</sub>):</div><br />
           <?php echo $form->textField($Rent,'square',array('class'=>'input_square')); ?></td>
    </tr>
</table>
  </div>

<div id="multiAccordionAll" class="pdd_30">
<?php foreach ($Rent->descriptions as  $key => $model)  {?>
    <h3><?php echo $model->lang->name?></h3>
    <div>
<?php echo $form->hiddenField($model,'['.$key.']language',array('class'=>'f_form')); ?>
<div class="stl_2"><?php echo Yii::t('default','bill name') ?>:</div>
<div>
<?php echo $form->error($model,'['.$key.']name'); ?>
<?php echo $form->textField($model,'['.$key.']name',array('class'=>'f_form nameinput', 'id'=>'f_count_input')); ?>
<span class="elem_counter"></span>
</div>
<div class="stl_2"><?php echo Yii::t('default','bill overview') ?>:</div>
<div> <?php echo $form->error($model,'['.$key.']overview'); ?>
    <?php echo $form->textArea($model,'['.$key.']overview',array('class'=>'f_form nametextarea','rows'=>'15','cols'=>'20','maxlength'=>'1000', 'id'=>'f_counter_1')); ?><div class="hint"><?php echo Yii::t('default','bill overview example')?>
</div>
</div>
<div class="stl_2"><?php echo Yii::t('default','bill rules') ?>:</div>
<div> <?php echo $form->error($model,'['.$key.']rules'); ?>
    <?php echo $form->textArea($model,'['.$key.']rules',array('class'=>'f_form nametextarea_rules','rows'=>'7','cols'=>'20','maxlength'=>'480', 'id'=>'f_counter_2')); ?>
<div class="hint"><?php echo Yii::t('default','bill rules example')?></div>
</div>
</div>
<?php } ?>
</div>

<?php 
 echo CHtml::link('<span><b><i>' . Yii::t('default','add bill') . '</i></b></span>','javascript:void(0)',array('onclick'=>'document.createrent.submit();','class'=>'btn_marg abutton blue'));
?>
<?php $this->endWidget(); ?>
<script type="text/javascript">

$(document).ready(function($){
    $(".nametextarea").charCount({allowed: 1000, warning: 50, counterText: " <?php echo Yii::t('default','symbols left')?>"});
    $(".nametextarea_rules").charCount({allowed: 480, warning: 50, counterText: " <?php echo Yii::t('default','symbols left')?>"});
    $(".nameinput").charCount({allowed: 130, warning: 50, counterText: " <?php echo Yii::t('default','symbols left')?>"});

});
</script>
              </div></td>
          </tr>
        </table>
      </div>
    </div>
  </div>