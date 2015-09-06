<?php $viewdescription = (isset($rent->descriptions[0]))?$rent->descriptions[0]:RentDescription::model()->findByPk(array('rent'=>$rent->id,'language'=>1)); 
$this->pageTitle=$viewdescription->name;
?>

<img style="display: none" src="<?php echo $this->assetsUrl ?>/images/map-indi.png" id="flat_indicator">
<script type="text/javascript">$(function() {$(".flash-alert-success").fadeOut(10000);});
$(function() {
    $('#close').click(function(){
        $('.no_full_rent').css({'display':'none'});
    });
    init_tiptip();
    $("#autocomplete").focus(function() {

  $('#tiptip_holder_free').css({'display':'block'});
});
    $("#autocomplete").blur(function() {

  $('#tiptip_holder_free').css({'display':'none'});
});
});</script>

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
<?php $this->widget('ext.widgets.editRentMenuWidget.editRentMenuWidget',array('rentid' => $rent->id,'active' => 'place','in_show' => $rent->in_show));?>
            </td>
            <td class="controller_right_side" valign="top">
            <div class="controller_edit">
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

                    

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'editrent',
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	),
                 'htmlOptions'=>array(
                     'name'=>'editrent',
                 )
)); ?>      <input type="hidden" value="" name="newdoc" id="newdoc">


    <div class="stl_2" id="district"><?php echo $form->labelEx($addrform,'adress_name'); ?></div>
<div class="search_yamap_box">
<?php echo CHtml::hiddenField('hasgeo', $hasgeo);?>

        <?php echo $form->hiddenField($addrform,'adress_prefix'); ?>

    <?php echo $form->textField($addrform,'adress_name',array('style'=>'width:585px; padding-right:5px;','onkeyup'=>'showvalue(this);hasChange = true;','autocomplete'=>"off", 'id'=>'autocomplete','encode'=>false)); ?>

    <a id="finder" class="yamap_submit" href="javascript:void(0)"></a>

    
    <div id="tiptip_holder_free" style="width: 130px; margin: 40px 0px 0px 625px;" class="tip_bottom">
<div id="tiptip_arrow_free" style="margin-left: 20px; margin-top: -12px;">
<div id="tiptip_arrow_inner_free"></div>
</div>
<div id="tiptip_content_free"><?php echo Yii::t('default','set.indicator.at.map')?></div>
</div>
    
    
    
    </div>
    <div class="clr"></div>
<div class="hint"><?php echo Yii::t('default','press arrowed button to find place on map')?><br><?php echo Yii::t('default', 'or set manually')?></div>
              
<div class="clr"></div>
<div class="gmap" style="width:656px;"><div id="YMapsID" style="width:656px;height:250px"></div></div>

<?php 
    echo CHtml::link('<span><b><i>'. Yii::t('default','save bill button') . '</i></b></span>','javascript:void(0)',array('onclick'=>'document.editrent.submit()','class'=>'mrg_top_20 mrg_bottom_20 abutton blue'));
    ?>

<div class="clr"></div>
<?php echo $form->hiddenField($addrform,'geopoint'); ?>
<?php $this->endWidget(); ?>
              </div></div></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
    
<script type="text/javascript">
function showvalue(searchinput,getregions){
    if(getregions==undefined)getregions = false;
    $.ajax({
	url: "/short_name.php",
	dataType: 'json',
	type:'post',
	data:{search: searchinput.value, neededregions:getregions},
	success:function(data){
	    subsearch = $('#subsearch');
	    subsearch.children().remove();
	    if(data.adresses!=undefined) $("input#autocomplete").autocomplete({source: data.adresses});
	}
    })
}
    
    

</script>

<script src="http://api-maps.yandex.ru/1.1/index.xml?key=<?php echo Yii::app()->params['yandexKey']?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->getAssetsUrl()?>/js/yamap.js"></script>
<script type="text/javascript">document.getElementById('finder').onclick=function(){addrToGeopoint();};</script>
