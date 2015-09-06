<?php $viewdescription = (isset($rent->descriptions[0]))?$rent->descriptions[0]:RentDescription::model()->findByPk(array('rent'=>$rent->id,'language'=>1)); 
$this->pageTitle=$viewdescription->name;
?>
<script type="text/javascript">
$(function() {
    $('#close').click(function(){
        $('.no_full_rent').css({'display':'none'});
    });
});</script>
<div class="main one">
    <div class="mainhead">
	<div>
	    <div>
		<div></div>
		<table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><?php echo $viewdescription->name;?></td><td><a href="/search/" class="search_btn flt_r popEdge" title="<?php echo Yii::t('default','search.button');?>"></a></td></tr></table>
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
<?php $this->widget('ext.widgets.editRentMenuWidget.editRentMenuWidget',array('rentid' => $rent->id,'active' => 'photo'));?>
		    </td>
		    <td class="controller_right_side" valign="top">

			<div class="controller_edit" id="returnform">
			    <div class="controller_pdd">
                                    <?php
                                    $this->widget('xupload.XUpload', array(
                                        'url' => Yii::app()->createUrl("rent/$rent->id/edit/photos/upload"),
                                        'model' => $model,
                                        'attribute' => 'file',
                                        'multiple' => true,
                                     ));
                                    ?>
                                
                                
                                
                                
                                
                                





				<div class="no_public">

                                    
                                    
                                    
                                    

                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
				    <?php

				    $form = $this->beginWidget('CActiveForm', array(
					'id' => 'editrent',
					'clientOptions' => array(
					    'validateOnSubmit' => true,
					), 'htmlOptions' => array('enctype' => 'multipart/form-data'),
					    ));


//if (preg_match("/(Firefox(?:\/|\s)3.6)/i", $_SERVER['HTTP_USER_AGENT'])) {
    echo $form->error($newphoto,'file',array('style'=>'left:730px'));
    echo $form->fileField($newphoto,'file',array('id'=>'newfile', 'style'=>"display: none"));?>
    <center>
    <a class="btn_border abutton blue" id="non-standart-button" href="javascript:void(0)" onclick="$('#newfile').click();"><span><b><i><?php echo Yii::t('default','add photo to bill')?></i></b></span></a>
    <div id="loading" style="display: none;text-align: center;" class="pdd_10"><br/>
	<?php echo Yii::t('default','uploading image')?><div><img src="<?php echo $this->getAssetsUrl();?>/images/loading.gif" /></div></div>
        <div><?php echo CHtml::link(Yii::t('default','switch.to.ctandart.html.input'),'javascript:void(0)',array('id'=>'switcher'))?></div>
</center>
   
                                    <br/><br/>
   <!-- <a class="btn_border abutton blue" href="javascript:void(0)" onclick="$('#editrent').submit();"><span><b><i><?php echo Yii::t('default','loading')?></i></b></span></a> -->
        <?php
//} else {
?>
<!--
<center>
    <a class="btn_border abutton blue" href="javascript:void(0)" onclick="$('#newfile').click();"><span><b><i><?php echo Yii::t('default','add photo to bill')?></i></b></span></a>
    <div id="loading" style="display: none;text-align: center;" class="pdd_10"><br/>
	<?php //echo Yii::t('default','uploading image')?><div><img src="<?php echo $this->getAssetsUrl();?>/images/loading.gif" /></div></div>
</center>-->
<?php //echo $form->fileField($newphoto, 'file', array('id' => 'newfile', 'style'=>"display: none"));
//echo $form->error($newphoto, 'file');
//} 
?> 
<?php $this->endWidget(); ?>               

				    <div class="clr"></div>
				    <div class="pdd_5"></div>
				    <p style="margin:0;"><?php echo Yii::t('default','image limits')?></p>
				</div>
				<div class="place_box" style="display:none;">
<?php foreach ($rent->photos as $key => $photo) { ?>
    				    <div class="place_box_pic" id="count<? echo $key;?>">
                                        <div style="background: url('/uploads/rentpic/
                                        <?php 
                                            echo Yii::app()->putils->fragment($photo->rent)
                                            .'/thumbs/'.$photo->file;?>') 
                                            no-repeat center center; width:130px; height:105px;"></div>
                                        <span class="btndelete" id="c<? echo $key;?>"><a href="javascript:void(0)" title="<?php echo Yii::t('default','drop bill image')?>" OnClick="dropimg('<?php echo $photo->id ?>','<?php echo $key;?>','<?php echo $this->getAssetsUrl();?>')"><?php echo Yii::t('default','drop bill image')?></a></span>
    				    </div>
<?php } ?> 

				</div>
                                
				<script type ="text/javascript">       
				    $(document).ready(function(){
					$('#switcher').click(function(){
					    $('#newfile').css({'display':'inline'});
					    $('#non-standart-button').css({'display':'none'});
					    $('#switcher').css({'display':'none'});
					});
					$('#editrent input').change(function(){
					    $('#loading').css({'display':'block'});
					    document.forms.editrent.submit();
					});
				    });
				</script>  
				<!-- end photos block -->  
                                
                        <table border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr>

        <td width="50%"><a class="link flt_r" href="/rent/<?php echo $rent->id?>"  target="_blank"><?php echo Yii::t('default','rent.view');?></a></td>
    </tr>
</table>
				<div class="clr"></div>
			    </div><div class="pdd_10"></div></div></td>
		</tr>
	    </table>
	</div>
    </div>
</div>
