<script type="text/javascript">
$(document).ready(function($){
    $(".nametextareaz, .nametextareaz2,.nametextareaz3").charCount({allowed: <?php echo Yii::app()->params['maxlength']['RentEditOverview']?>, warning: 50, counterText: " <?php echo Yii::t('default','symbols left')?>"});
    $(".nametextarea_rulesz, .nametextarea_rulesz2, .nametextarea_rulesz3").charCount({allowed: <?php echo Yii::app()->params['maxlength']['RentEditRules']?>, warning: 50, counterText: " <?php echo Yii::t('default','symbols left')?>"});
    $(".nameinputz, .nameinputz2, .nameinputz3").charCount({allowed: <?php echo Yii::app()->params['maxlength']['RentEditName']?>, warning: 50, counterText: " <?php echo Yii::t('default','symbols left')?>"});

});
</script>


<h3 class="ui-accordion-header ui-helper-reset ui-state-active ui-corner-top"><span class="ui-icon ui-icon-triangle-1-s"></span><?php echo $langname?></h3><div class="ui-accordion-content-active ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" style="display: block;">

 
<?php echo CHtml::link(Yii::t('default','drop description locale'),'javascript:void(0)',array('onclick'=>'javascript:RemoveMe(this, "'.$key.'", "'.$langname.'")','class'=>'delete_lang_rent flt_r', 'style'=>'margin-top:16px;'));?>
<?php echo CHtml::hiddenField('RentDescription['.$key.'][language]', $key ,array('class'=>'f_form')); ?>
<div class="stl_2"><?php echo Yii::t('default','bill name'); ?>:</div>
<div>
<?php echo CHtml::textField('RentDescription['.$key.'][name]','',array('class'=>'f_form nameinputz'.$key.'')); ?>
<span class="elem_counter"></span>
</div>
<div class="stl_2"><?php echo Yii::t('default','bill overview'); ?>:</div>
<div>
    <?php echo CHtml::textArea('RentDescription['.$key.'][overview]','',array('class'=>'f_form  nametextareaz'.$key.'','rows'=>'8','cols'=>'20','maxlength'=>Yii::app()->params['maxlength']['RentEditOverview'])); ?>
<div class="hint"><?php echo Yii::t('default','bill overview example')?></div>
</div>
<div class="mrg_btm_30">
<div class="stl_2"><?php echo Yii::t('default','bill rules'); ?>:</div>
<div>
    <?php echo CHtml::textArea('RentDescription['.$key.'][rules]','',array('class'=>'f_form  nametextarea_rulesz'.$key.'','rows'=>'7','cols'=>'20','maxlength'=>Yii::app()->params['maxlength']['RentEditRules'])); ?>
<div class="hint"><?php echo Yii::t('default','bill rules example')?></div>
</div>
</div>
</div>


 
