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
	'id' => 'RemindPass',
	'clientOptions' => array(
	    'validateOnSubmit' => true,
	),
	'htmlOptions' => array('name' => 'RemindPass'),
	    ));
    ?>      
    <br/>
    <br/>
    <table border="0" width="50%" cellpadding="0" cellspacing="0" style="margin:0 140px;" class="register_page remid">
	<tr>
	    <td width="50%" align="right"><?php echo $form->labelEx($remindForm, 'email',array('style'=>'padding-right:10px;')); ?></td>
            <td width="50%"><?php echo $form->error($remindForm, 'email'); ?><?php echo $form->textField($remindForm, 'email'); ?></td>
	</tr>
	    <td width="100%" colspan="2"><div style="padding:10px 0 0 15px;"><center>
<?php  echo CHtml::link('<span><b><i>'.Yii::t('default','send').'</i></b></span>','javascript:void(0)',array('onclick'=>'document.RemindPass.submit();return false','class'=>'btn_border abutton yellow')); ?>
                    </center></div></td>
	</tr>
    </table>
    <?php $this->endWidget(); ?>
    <br/>
    <br/>

</div>

    </div>
    
</div>



