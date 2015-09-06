

<?php $viewdescription = (isset($rent->descriptions[0]))?$rent->descriptions[0]:RentDescription::model()->findByPk(array('rent'=>$rent->id,'language'=>1)); 
$this->pageTitle=$viewdescription->name;
?>

<script type="text/javascript">$(function() {$(".flash-alert-error, .flash-alert-success").fadeOut(10000);});
$(function() {
    $('#close').click(function(){
        $('.no_full_rent').css({'display':'none'});
    });
});
</script>
<script>
mr_dialog_edit_rent('<?php echo Yii::t('default','dialog.editrent.title')?>', '<?php echo Yii::t('default','dialog.yes')?>', '<?php echo Yii::t('default','dialog.no')?>', '<?php echo Yii::t('default','dialog.cancel')?>');
</script>

<div id="dialog"></div>
<div class="main one">
    <div class="mainhead">
      <div>
        <div>
          <div></div>
          <table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><?php echo preg_replace('/([\,\.])(?!\s)/ui', '$1 ', $viewdescription->name)?></td><td><a href="/search/" class="search_btn flt_r popEdge" title="<?php echo Yii::t('default','search.button');?>"></a></td></tr></table>
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
<?php $this->widget('ext.widgets.editRentMenuWidget.editRentMenuWidget',array('rentid' => $rent->id,'active' => 'price','in_show' => $rent->in_show));?>
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
              <div class="controller_pdd">
                <b class="stl_2"><?php echo Yii::t('default', 'bill rent price') ?>:</b>
                <div class="example"><?php echo Yii::t('default','rent price context') ?></div><br />
           <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'editrent',
	'clientOptions'=>array(
	'validateOnSubmit'=>true
	),
        'htmlOptions'=>array('name'=>'editrent')
)); ?>


             <input type="hidden" value="" name="newdoc" id="newdoc">
             <table border="0" width="100%" cellpadding="0" cellspacing="0"><tr><td width="23%"><b style="margin-left: 6px;"><?php echo Yii::t('default','select.currency');?>:</b></td><td align="left">
		 <?php echo $form->dropDownList($rent,'currency_id',CHtml::listData($currency, 'id', 'full_name'),array('id'=>'select_currency'))?>
		     
		     </td></tr></table><br/>
              <table border="0" width="100%" cellpadding="6" cellspacing="0" id="edit_rent_price">
<tr>
    <td width="20%"><div class="label_box" style="margin-top: 7px;"><input id="day" class="flt_l" type="checkbox" name="Nightly" <?php if($rent->price_day) {?>  checked="checked"<?php }?> /><label for="day" class="lab_checkbox"><b><?php echo Yii::t('default', 'price_day') ?>:</b></label></div></td>
    <td width="30%">
         <?php echo $form->error($rent,'price_day'); ?>
        <?php echo $form->textField($rent,'price_day',array('maxlength'=>9, 'style'=>'width:180px;')); ?>
    </td>
    <td width="50%" align="left">
<b class="currency_short"></b>
    </td>
</tr>
<tr>
    <td width="20%"><div class="label_box" style="margin-top: 7px;"><input id="week" class="flt_l" type="checkbox" name="Weekly" <?php if($rent->price_week) {?>  checked="checked"<?php }?> /><label for="week" class="lab_checkbox"><b><?php echo Yii::t('default', 'price_week') ?>:</b></label></div></td>
    <td width="30%">
         <?php echo $form->error($rent,'price_week'); ?>
        <?php echo $form->textField($rent,'price_week',array('maxlength'=>9, 'style'=>'width:180px;')); ?>
    </td>
    <td width="50%" align="left">
<b class="currency_short"></b>
    </td>
</tr>
<tr>
    <td width="20%"><div class="label_box" style="margin-top: 7px;"><input id="month" class="flt_l" type="checkbox" name="Monthly" <?php if($rent->price_month) {?>  checked="checked"<?php }?> /><label for="month" class="lab_checkbox"><b><?php echo Yii::t('default', 'price_month') ?>:</b></label></div></td>
    <td width="30%">
         <?php echo $form->error($rent,'price_month'); ?>
        <?php echo $form->textField($rent,'price_month',array('maxlength'=>9, 'style'=>'width:180px;')); ?>
    </td>
    <td width="50%" align="left">
<b class="currency_short"></b>    </td>
</tr>

</table>
                
             <div class="example" style="margin-left: 0"><br/><br/><?php echo Yii::t('default', 'set showed price')?><br/><br/></div>
                <div class="terms_box">
                <?php echo $form->radioButtonList($rent,'current_price',$prices_types,array('separator'=>' ','class'=>'terms', 'id'=>'none')); ?>
                </div>
                                <div class="clr"></div>
<div class="pdd_10"></div>

                   <?php $this->endWidget(); ?>
                <script type="text/javascript">
                hasChange = false;    
            </script>
              </div>
<?php 
    echo CHtml::link('<span><b><i>'. Yii::t('default','save bill button') . '</i></b></span>','javascript:void(0)',array('onclick'=>'document.editrent.submit();','class'=>'btn_marg abutton blue'));
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
	$(".terms").imageTick({
		image_tick_class: "terms",
		custom_button: function($label){
		    $label.hide();
		    return '<div><span>' + $label.text() + '</span></div>';
		}
        });


});
</script>
<script type="text/javascript">
<!--
jQuery(document).ready(function(){

    var params = {
            changedEl: "#select_currency",
            visRows: 5,
            scrollArrows: false

    }
    cuSel(params);

               var form_name = document.editrent;
        var CheckNightly = form_name.elements[2];
        var InputNightly = form_name.elements[3];
        
        var CheckWeekly = form_name.elements[4];
        var InputWeekly = form_name.elements[5];
        
        var CheckMonthly = form_name.elements[6];
        var InputMonthly = form_name.elements[7]; 
 

/*Проверка если все отключено то всеравно обязательно заполнить цену за день!*/
if($('input[type="checkbox"]:checked').length==0){
    $(CheckNightly).attr('checked',true);
    $(InputNightly).attr('disabled',false).val('1');
}


if($(InputWeekly).val()==0){
     $('#tick_img_Rent_current_price_1').removeClass('selected_radio');
    // $('#tick_img_Rent_current_price_0').addClass('selected_radio');
}
if($(InputMonthly).val()==0){
     $('#tick_img_Rent_current_price_2').removeClass('selected_radio');
    // $('#tick_img_Rent_current_price_0').addClass('selected_radio');
}


function HasCheckedWeek(){
       if($('#week').is(':checked')){
           $('#tick_img_Rent_current_price_1').addClass('selected_radio');
           return true;
       }else{
           $('#tick_img_Rent_current_price_1').removeClass('selected_radio');
           return false;
       }
}
function HasCheckedMonth(){
       if($('#month').is(':checked')){
           $('#tick_img_Rent_current_price_2').addClass('selected_radio');
           return true;
       }else{
           $('#tick_img_Rent_current_price_2').removeClass('selected_radio');
           return false;
       }
}



$('input[type="checkbox"]').bind('click', function(){
    if($(this).is(':checked')){
        $('#tick_img_Rent_current_price_0, #tick_img_Rent_current_price_1, #tick_img_Rent_current_price_2').removeClass('selected_radio');
        if($(this).attr('id')=='day'){
            $('#tick_img_Rent_current_price_0').addClass('selected_radio');
        } else if($(this).attr('id')=='week'){
            $('#tick_img_Rent_current_price_1').addClass('selected_radio');
        }else{
            $('#tick_img_Rent_current_price_2').addClass('selected_radio');
        }
    }else{
        $('#tick_img_Rent_current_price_0, #tick_img_Rent_current_price_1, #tick_img_Rent_current_price_2').removeClass('selected_radio');
        if($(this).attr('id')=='day'){

            $('#tick_img_Rent_current_price_0').addClass('selected_radio');
        } else if($(this).attr('id')=='week'){
            $('#tick_img_Rent_current_price_0').addClass('selected_radio');
        }else{
            $('#tick_img_Rent_current_price_0').addClass('selected_radio');
        }
    }
});
    /*function hascheck(){
        var len = $('input[type="checkbox"]:checked').first().attr('id');
        var radio = $('input[type="radio"]:checked').attr('id');
        if(len == 'day') var check = '0';
        if(len == 'week') var check = '1';
        if(len == 'month') var check = '2';


       // $('#Rent_current_price_0, #Rent_current_price_1, #Rent_current_price_2').removeAttr('checked');
        //$('#Rent_current_price_'+check+'').attr('checked','checked');
        //$('#tick_img_Rent_current_price_0, #tick_img_Rent_current_price_1, #tick_img_Rent_current_price_2').removeClass('selected_radio');
        //$('#tick_img_Rent_current_price_'+check+'').addClass('selected_radio');
    }*/

/*выбор валюты*/
$('.cusel-scroll-wrap span').click(function(){
    $('.currency_short').html($(this).text());
});
$('.currency_short').html($('.cuselText').text());
/*выбор валюты*/

        //Nightly
	if($(CheckNightly).prop('checked') == true){
            $(InputNightly).removeAttr('readonly');
           // $('#cuselFrame-select_currency_day').css({'visibility':'visible'});
            $('#Rent_current_price_0').removeAttr("disabled");
            $(CheckNightly).click(function() {
                if (!$(CheckNightly).attr('checked')) {
                    $(InputNightly).attr('readonly', 'readonly').css({'opacity': '0.3'}).val('0');
                    $('#Rent_current_price_0').attr("disabled","disabled");
                   // $('#cuselFrame-select_currency_day').css({'visibility':'hidden'});
                } else {
                    $(InputNightly).removeAttr('readonly').css({'opacity': 1});
                    $('#Rent_current_price_0').removeAttr("disabled");
                   // $('#cuselFrame-select_currency_day').css({'visibility':'visible'});
                }
                hascheck();
            });
	}else{
            $('#Rent_current_price_0').attr("disabled","disabled");
            $(InputNightly).attr('readonly', 'readonly').css({'opacity': '0.3'});
            //$('#cuselFrame-select_currency_day').css({'visibility':'hidden'});
            $(CheckNightly).click(function() {
                if ($(CheckNightly).attr('checked')) {
                    $(InputNightly).removeAttr('readonly').css({'opacity': 1});
                    $('#Rent_current_price_0').removeAttr("disabled").attr('checked', 'checked');
                    //$('#cuselFrame-select_currency_day').css({'visibility':'visible'});
                } else {
                    $(InputNightly).attr('readonly', 'readonly').css({'opacity': '0.3'}).val('0');
                    $('#Rent_current_price_0').attr("disabled","disabled");
                    //$('#cuselFrame-select_currency_day').css({'visibility':'hidden'});
                }
               hascheck();
            });
	}
        
        
	// Weekly
	if($(CheckWeekly).prop('checked') == true){
            $(InputWeekly).removeAttr('readonly');
            $('#Rent_current_price_1').removeAttr("disabled");
           // $('#cuselFrame-select_currency_week').css({'visibility':'visible'});
            $(CheckWeekly).click(function() {
                if (!$(CheckWeekly).attr('checked')) {
                    $(InputWeekly).attr('readonly', 'readonly').css({'opacity': '0.3'}).val('0');
                    $('#Rent_current_price_1').attr("disabled","disabled");
                   // $('#cuselFrame-select_currency_week').css({'visibility':'hidden'});
                } else {
                    $(InputWeekly).removeAttr('readonly').css({'opacity': 1});
                    $('#Rent_current_price_1').removeAttr("disabled");
                    //$('#cuselFrame-select_currency_week').css({'visibility':'visible'});
                }
                hascheck();
            });
	}else{
            $('#Rent_current_price_1').attr("disabled","disabled");
            $(InputWeekly).attr('readonly', 'readonly').css({'opacity': '0.3'});
           // $('#cuselFrame-select_currency_week').css({'visibility':'hidden'});
            $(CheckWeekly).click(function() {
                if ($(CheckWeekly).attr('checked')) {
                    $(InputWeekly).removeAttr('readonly').css({'opacity': 1});
                    $('#Rent_current_price_1').removeAttr("disabled").attr('checked', 'checked');
                   // $('#cuselFrame-select_currency_week').css({'visibility':'visible'});
                } else {
                    $(InputWeekly).attr('readonly', 'readonly').css({'opacity': '0.3'}).val('0');
                    $('#Rent_current_price_1').attr("disabled","disabled");
                   // $('#cuselFrame-select_currency_week').css({'visibility':'hidden'});
                }
                hascheck();
            });
	}
        
        
        
        
        
        
	//Monthly
	if($(CheckMonthly).prop('checked') == true){
            $(InputMonthly).removeAttr('readonly');
            $('#Rent_current_price_2').removeAttr("disabled","disabled");
           // $('#cuselFrame-select_currency_month').css({'visibility':'visible'});
            $(CheckMonthly).click(function() {
                if (!$(CheckMonthly).attr('checked')) {
                    $(InputMonthly).attr('readonly', 'readonly').css({'opacity': '0.3'}).val('0');
                    $('#Rent_current_price_2').attr("disabled","disabled");
                    //$('#cuselFrame-select_currency_month').css({'visibility':'hidden'});
                } else {
                    $(InputMonthly).removeAttr('readonly').css({'opacity': 1});
                    $('#Rent_current_price_2').removeAttr("disabled");
                    //$('#cuselFrame-select_currency_month').css({'visibility':'visible'});
                }
                hascheck();
           
            });
	}else{
            $('#Rent_current_price_2').attr("disabled","disabled");
            $(InputMonthly).attr('readonly', 'readonly').css({'opacity': '0.3'});
            //$('#cuselFrame-select_currency_month').css({'visibility':'hidden'});
            $(CheckMonthly).click(function() {
                if ($(CheckMonthly).attr('checked')) {
                    $(InputMonthly).removeAttr('readonly').css({'opacity': 1});
                    $('#Rent_current_price_2').removeAttr("disabled").attr('checked', 'checked');
                    // $('#cuselFrame-select_currency_month').css({'visibility':'visible'});
                } else {
                    $(InputMonthly).attr('readonly', 'readonly').css({'opacity': '0.3'}).val('0');
                    $('#Rent_current_price_2').attr("disabled","disabled");
                   //  $('#cuselFrame-select_currency_month').css({'visibility':'hidden'});
                }
                hascheck();
            });
	}
hascheck();

 });
-->
</script>
