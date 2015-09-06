<?php $viewdescription = (isset($rent->descriptions[0]))?$rent->descriptions[0]:RentDescription::model()->findByPk(array('rent'=>$rent->id,'language'=>1)); 
$this->pageTitle=$viewdescription->name;
?>
<script type="text/javascript">
$(function() {
    $('#close').click(function(){
        $('.no_full_rent').css({'display':'none'});
    });
});</script>

<script type="text/javascript">
function cover(id){
    $('#cover_id_'+id+' .btn').css({'display':'none'});
    $('#cover_id_'+id+' .loading_cover').css({'display':'inline'});

    $.ajax({
	url: '<?php echo Yii::app()->request->requestUri ?>',
	type:'post',
	data:{
	    cover:id
	},
	success:function(data){
            $('.place_box_pic').removeClass('cover');
            $('#cover_id_'+id).addClass('cover');
                $('#cover_id_'+id+' .btn').css({'display':'inline'});
                $('#cover_id_'+id+' .loading_cover').css({'display':'none'});


	}
    });
    return false;
}
</script>

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
<?php $this->widget('ext.widgets.editRentMenuWidget.editRentMenuWidget',array('rentid' => $rent->id,'active' => 'photo','in_show' => $rent->in_show));?>
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
			    </div><div class="pdd_10"></div></div></td>
		</tr>
	    </table>
	</div>
    </div>
</div>
