<!-- The file upload form used as target for the file upload widget -->
<?php echo CHtml::beginForm('/rent/'.$this -> model->id.'/edit/photos/uploadget', 'post', $this -> htmlOptions);?>


    	<div class="no_public">
        <center>
    <a class="btn_border abutton blue fileinput-button" href="javascript:void(0)"><span><b><i><?php echo Yii::t('default','add photo to bill')?></i></b></span>
    


    
    

    			<?php
            if ($this -> hasModel()) :
                echo CHtml::activeFileField($this -> model, $this -> attribute, $htmlOptions) . "\n";
            else :
                echo CHtml::fileField($name, $this -> value, $htmlOptions) . "\n";
            endif;
            ?>
    
    </a></center>
				    <div class="clr"></div>
				    <div class="pdd_5"></div>
				    <p style="margin:0;"><?php echo Yii::t('default','image limits')?></p>
</div>

<!-- The loading indicator is shown during image processing -->
<div class="fileupload-loading"></div>
<br>
<!-- The table listing the files available for upload/download -->
<!--<table class="table table-striped">
	<tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
</table>-->



<div class="clr"></div>
<center><span id="ploader" style="display:none"><img src="<?php echo $this->assets;?>/img/loading.gif" alt="" /></span></center>
<div class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></div>
<?php echo CHtml::endForm();?>
