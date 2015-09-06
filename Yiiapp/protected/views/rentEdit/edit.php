<?php $viewdescription = (isset($rent->descriptions[0]))?$rent->descriptions[0]:RentDescription::model()->findByPk(array('rent'=>$rent->id,'language'=>1)); 
if (!$viewdescription) $viewdescription = new RentDescription ();
$this->pageTitle=$viewdescription->name;
?>

<script>
mr_dialog_edit_rent('<?php echo Yii::t('default','dialog.editrent.title')?>', '<?php echo Yii::t('default','dialog.yes')?>', '<?php echo Yii::t('default','dialog.no')?>', '<?php echo Yii::t('default','dialog.cancel')?>');
</script>

<div id="dialog"></div>


<script type="text/javascript">
     $('input').change(function(){

        alert('change');
    });
    $(function() {
    $('#close').click(function(){
        $('.no_full_rent').css({'display':'none'});
    });
});
</script>
<script type="text/javascript">
$(function() {$(".flash-alert-success").fadeOut(10000);});
$(function() {$(".flash-alert-error").fadeOut(10000);});
</script>
<script type="text/javascript">
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
          <table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle">
	      <?php echo preg_replace('/([\,\.])(?!\s)/ui', '$1 ', $viewdescription->name)?>
		  
		  </td><td><a href="/search/" class="search_btn flt_r popEdge" title="<?php echo Yii::t('default','search.button');?>"></a></td></tr></table>
        </div>
      </div>
    </div>
    <div class="content">
<?php if(!$rent->isFull) {?>
<div class="no_full_rent">
    <span style="float:left"><?php echo Yii::t('default','no full rent')?></span>
    <a id="close" href="javascript:void(0)" class="close flt_r"></a>
     <div class="clr"></div>
</div>
<?php }?>
      <div class="tab_content">
        <table style="width:100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td class="controller_left_side" valign="top">

                
<?php $this->widget('ext.widgets.editRentMenuWidget.editRentMenuWidget',array('rentid' => $rent->id,'active' => 'description','in_show' => $rent->in_show));?>
                
                
            </td>
            <td class="controller_right_side" valign="top">
		
                <div class="controller_edit" id="returnform">


		    
		    
<?php if(Yii::app()->user->hasFlash('error')):?>
<div class="flash-alert-error">
<?php echo Yii::app()->user->getFlash('error')?>
</div>
                    <script type="text/javascript">hasChange = true;</script>
<?php endif?>
<?php if(Yii::app()->user->hasFlash('success')):?>
<div class="flash-alert-success">
<?php echo Yii::app()->user->getFlash('success')?>
</div>
                    <script type="text/javascript">hasChange = false;</script>
<?php endif?>

                    
<script type="text/javascript">
$(function() {  
    $('#editrent textarea').keyboard('ctrl+enter', function(e, bind) {
        $("#editrent").submit();
        return false;
    });
});
</script>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'editrent',
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	),
                   'htmlOptions'=>array('name'=>'editrent')

)); ?>
                    
               
                    
                    
      <input type="hidden" value="" name="newdoc" id="newdoc" />
                    <div class="pdd_30">
                   
<div class="panix">
<div class="stl_2"><?php echo Yii::t('default','bill action')?>:</div>
<ul class="collector" style="width: 165px;display:block">
<li>
<?php echo $form->radioButtonList($rent,'todo',$Todo,array('separator'=>'</li><li>','class'=>'imageTickTodo')); ?>
</li>
</ul>
</div>

<div class="panix">
<div class="stl_2"><?php echo Yii::t('default','bill type')?>:</div>
<ul class="collector">
<li>
<?php echo $form->radioButtonList($rent,'type',$Types,array('separator'=>'</li><li>','class'=>'imageTickType')); ?>
</li>
</ul>
</div>


                    
<div class="clr"></div>
<table border="0" width="600" cellpadding="0" cellspacing="0">
    <tr>
       <td width="220" valign="top"><div class="stl_2"><?php echo Yii::t('default','bill rooms count')?>:</div>

               
               
                               <table border="0" cellpadding="0" cellspacing="0" class="num_rooms_box" style="margin-left:0px;width:auto">
                    <tr>
                        <td><?php echo $form->radioButtonList($rent,'rooms_count',Yii::app()->params['rooms'],array('separator'=>' ','class'=>'checkroom')); ?></td>
                    </tr>
                </table>
               
               
 
                  <div class="clr"></div>

 
       </td> 
       <td width="170" valign="top"><div class="stl_2"><?php echo Yii::t('default','bill floor')?>:</div>
       
           <div>
			       <?php echo $form->dropDownList($rent,'floor',Yii::app()->params['floors_to_edit'], array('style'=>'width: 83px;'));?>
           </div>
       
       </td>
       <td width="150" valign="top"><div class="stl_2"><?php echo Yii::t('default','bill square')?> (m<sub>2</sub>):</div>
 <?php echo $form->textField($rent,'square',array('class'=>'input_square')); ?></td>
    </tr>
</table>
</div>




<div id="multiAccordionAll">




<?php foreach ($rent->descriptions as  $key => $model)  { ?>
    <h3><?php echo $model->lang->name?></h3><div class="accord_box"><?php if ($key!=1) {?><div id="adddescrdiv<?php echo $key?>" style="display: none">

     </div>

     <?php echo CHtml::link(Yii::t('default','Удалить язык'),'javascript:void(0)',array('onclick'=>'javascript:RemoveMe(this, "' . $key . '", "' . $model->lang->name . '")','class'=>'delete_lang_rent flt_r', 'style'=>'margin-top:16px;'));?>
	<?php }?>
<?php echo $form->hiddenField($model,'['.$key.']language',array('class'=>'f_form')); ?>
<div class="stl_2"><?php echo Yii::t('default','bill name') ?>:</div>
<div>
    <?php echo $form->error($model,'['.$key.']name'); ?>
<?php echo $form->textField($model,'['.$key.']name',array('class'=>'f_form nameinput','encode'=>false)); ?>
<span class="elem_counter"></span>
</div>
<div class="stl_2"><?php echo Yii::t('default','bill overview') ?>:</div>
<div> <?php echo $form->error($model,'['.$key.']overview'); ?>
    <?php echo $form->textArea($model,'['.$key.']overview',array('class'=>'f_form textarea nametextarea','rows'=>'15','cols'=>'20','maxlength'=>Yii::app()->params['maxlength']['RentEditOverview'],'encode'=>false)); ?>
<div class="hint"><?php echo Yii::t('default','bill overview example')?>
</div>


<div class="mrg_btm_30">
<div class="stl_2"><?php echo Yii::t('default','bill rules') ?>:</div>
<div> <?php echo $form->error($model,'['.$key.']rules'); ?>
    <?php echo $form->textArea($model,'['.$key.']rules',array('class'=>'f_form textarea nametextarea_rules','rows'=>'7','cols'=>'20','maxlength'=>Yii::app()->params['maxlength']['RentEditRules'],'encode'=>false)); ?>
<div class="hint"><?php echo Yii::t('default','bill rules example')?></div>
</div>

</div>

</div></div>
<?php } ?>
</div>
      <div id="preload"></div>
      <script type="text/javascript">

          $(function(){
              $('#select_lang').change(function(){
                  var LangVal = $(this).val();
                    $("#preload").append('<div id="body_loading" style="display:block;"><div class="free_layer" style="background:#FFF;opacity:0.6"></div><div class="loading_box" style="display:block; left:400px;position:fixed"><div class="wborder"><h3><?php echo Yii::t("default","Loading");?></h3><div class="loading_search"></div></div></div></div>');
                  $.ajax({
                      url:'/getDescriptionForm',
                      type: "POST",
                      data:({'lang': LangVal}),
                      success:function(data){
                          $('#preload #body_loading').css({'display':'none'});
                          $("#select_lang option:selected").remove();
                          $("#multiAccordionAll").append(data);
                          lang_select_length();
                          
                      }
                  });
              });
               lang_select_length();
          });  
      </script>

<?php $this->endWidget(); ?>
      <div id="add_lang_box" style="padding-left:40px">
                              <b class="stl_2"><?php echo Yii::t('default', 'add description locale'); ?>:</b><br /><br />
                              <b class="stl_5"><?php echo Yii::t('default', 'language'); ?>:</b> <select name="selectlang" id="select_lang"><option value="0">---</option>
      <?php foreach ($notExistLangs as $lang ){

      ?>
          <option id="language_<?php echo $lang->id?>" value="<?php echo $lang->id?>"><?php echo $lang->name?></option>
          <?php
      }?></select></div>

      

<?php 
    echo CHtml::link('<span><b><i>' . Yii::t('default','save bill button') . '</i></b></span>','javascript:void(0)',array('onclick'=>'document.editrent.submit();','class'=>'btn_marg abutton blue'));
    ?>


              </div></td>
          </tr>
        </table>
      </div>
    </div>
  </div>


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
        $(".checkroom").imageTick({
		image_tick_class: "checknum",
		custom_button: function($label){
		    $label.hide();
		    return '<span>' + $label.text() + '</span>';
		}
	});
 
});
</script>

<script type="text/javascript">
    init_tiptip();
</script>
<script type="text/javascript">
$(document).ready(function($){
    $(".nametextarea").charCount({allowed: <?php echo Yii::app()->params['maxlength']['RentEditOverview']?>, warning: 50, counterText: " <?php echo Yii::t('default','symbols left')?>"});
    $(".nametextarea_rules, .nametextarea_rules2, .nametextarea_rules3").charCount({allowed: <?php echo Yii::app()->params['maxlength']['RentEditRules']?>, warning: 50, counterText: " <?php echo Yii::t('default','symbols left')?>"});
    $(".nameinput, .nameinput2, .nameinput3").charCount({allowed: 130, warning: 50, counterText: " <?php echo Yii::t('default','symbols left')?>"});

});
</script>
 <?php echo CHtml::script('
function lang_select_length(){
    if($("#select_lang option").length == 1){
        $("#add_lang_box").css({"display":"none"});
    }else{
        $("#add_lang_box").css({"display":"block"});
    }
}

function RemoveMe(obj, keyz, langname){

$("#linkcontainer").append($("#adddescrdiv" + keyz).html());
$("#select_lang").append("<option value=\'"+keyz+"\'>"+langname+"</option>");
maindiv = obj.parentNode.parentNode;
maindiv.removeChild(get_previoussibling(obj.parentNode));
maindiv.removeChild(obj.parentNode);
}
function get_previoussibling(n)
{
x=n.previousSibling;
while (x.nodeType!=1)
  { 
  x=x.previousSibling;
  }
  lang_select_length();

return x;
}
')?>

                        
