    <div class="controller_pdd"><div class="no_public">


             <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'editrent',
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	),'htmlOptions'=>array('enctype'=>'multipart/form-data'),

)); ?>
<?php
    echo $form->error($newphoto,'file',array('style'=>'left:730px'));
    echo $form->fileField($newphoto,'file',array('id'=>'newfile', 'style'=>"display: none"));?>
    <center>
    <a class="btn_border abutton blue" id="non-standart-button" href="javascript:void(0)" onclick="$('#newfile').click();"><span><b><i><?php echo Yii::t('default','add photo to bill')?></i></b></span></a>
    <div id="loading" style="display: none;text-align: center;" class="pdd_10"><br/>
	<?php echo Yii::t('default','uploading image')?><div><img src="<?php echo $this->getAssetsUrl();?>/images/loading.gif" /></div></div>
    <div><?php echo CHtml::link(Yii::t('default','switch.to.ctandart.html.input'),'javascript:void(0)',array('id'=>'switcher'))?></div>
</center>
<br/><br/>
    
                <?php $this->endWidget(); ?>               


<div class="clr"></div>
<div class="pdd_5"></div>
<p style="margin:0;"><?php echo Yii::t('default','image limits')?></p>
</div>


                <div class="place_box">
                    
                    <?php    foreach ($rent->photos as $key => $photo){?>
                    
                    <div class="place_box_pic" id="count<? echo $key;?>"><!--<center><div>
                        <?php //echo CHtml::link('<img src="/uploads/rentpic/'.$photo->rent.'/thumbs/'.$photo->file.'" border="0" alt="'.Yii::t('default', 'Сделать обложкой').'" />',"javascript:void(0)",array('class'=>'pop', 'title'=>''.Yii::t('default', 'Сделать обложкой').'')) ?></div></center>-->
<div style="background: url('/uploads/rentpic/<?php echo $photo->rent.'/thumbs/'.$photo->file;?>') no-repeat center center; width:130px; height:105px;"></div>
	
                                <span class="btndelete" id="c<? echo $key;?>"><a href="javascript:void(0)" title="<?php echo Yii::t('default','drop bill image')?>" onclick="dropimg('<?php echo $photo->id ?>','<? echo $key;?>','<?php echo $this->getAssetsUrl();?>');"><?php echo Yii::t('default','drop bill image')?></a></span>
                                
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
<div class="clr"></div>
</div><div class="pdd_10"></div>