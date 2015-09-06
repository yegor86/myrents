<?php

$this->pageTitle = Yii::t('default', 'remid.title');

?>


<div class="main one">
    <div class="mainhead">
	<div>
	    <div>
		<div></div>
		<table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><?php echo Yii::t('default', 'remid.title') ?>
		
                        </td><td><a href="/search/" class="search_btn flt_r popEdge" title="<?php echo Yii::t('default', 'search.button'); ?>"></a></td></tr></table>
	    </div>
	</div>
    </div>
    <div class="content">


        
        
        
        
        
        
        
        
<div id="support_box_popup" style="border:0;margin-left: 120px;">

 <?php
    $form = $this->beginWidget('CActiveForm', array(
	'id' => 'ResetPass',
	'clientOptions' => array(
	    'validateOnSubmit' => true,
	),
	'htmlOptions' => array('name' => 'ResetPass'),
	    ));
    ?>      
    <br/>
    <br/>
    <table border="0" width="65%" cellpadding="5" cellspacing="0" style="margin:0 10px" class="register_page remid">
	<tr>
	    <td width="50%" align="right"><?php echo $form->labelEx($resetForm, 'passwd',array('style'=>'padding-right:10px;')); ?></td>
            <td width="50%"><?php echo $form->error($resetForm, 'passwd'); ?><?php echo $form->passwordField($resetForm, 'passwd'); ?></td>
	</tr>
	<tr style="padding:10px;">
	    <td width="50%" align="right"><?php echo $form->labelEx($resetForm, 'confirm',array('style'=>'padding-right:10px;')); ?></td>
            <td width="50%"><?php echo $form->error($resetForm, 'confirm'); ?><?php echo $form->passwordField($resetForm, 'confirm'); ?></td>
	</tr>
	    <td width="100%" colspan="2"><div style="padding:10px 0 0 130px;"><center>
<?php  echo CHtml::link('<span><b><i>'.Yii::t('default','send').'</i></b></span>','javascript:void(0)',array('onclick'=>'document.ResetPass.submit();return false','class'=>'btn_border abutton yellow')); ?>
                    </center></div></td>
	</tr>
    </table>
    <?php $this->endWidget(); ?>
    <br/>
    <br/>

</div>

    </div>
    
</div>



