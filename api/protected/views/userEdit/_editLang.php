<script type="text/javascript">$(function() {$("#langBox .flash-msg-success, #langBox .flash-msg-error").fadeOut(10000);});</script>
    
			    <?php
			    $form = $this->beginWidget('CActiveForm', array(
				'id' => 'edit-form',
				'clientOptions' => array(
				    'validateOnSubmit' => true,
				),
				'htmlOptions' => array('name' => 'editlang', 'class' => "border_top","id"=>'editLangForm'),
				    ));
			    ?>           
			    <?php
			    $this->widget('ext.widgets.LangStarWidget.LangStarWidget', array(
				'langs' => $langs,
				'langsArray' => $langsArray,
				'form' => $form,
				'user' => $user,
				'edit' => true
			    ));
			    ?><div class="mrg_lft_30 mrg_bottom_20 mrg_top_20 display_in_block">
<?php 
    echo CHtml::link('<span><b><i>'.Yii::t('default', 'save').'</i></b></span>','javascript:void(0)',array('onclick'=>'ajaxSubmitForm("#editLangForm","/user/edit","#langsResult", "load_box_lang")','class'=>'abutton blue'));
    ?>
                            </div>
<span id="load_box_lang" style="display:none"><img src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt=""></span>

    <span id="langBox">
<?php if(Yii::app()->user->hasFlash('error')):?>
<span class="flash-msg-error">
<?php echo Yii::app()->user->getFlash('error')?>
</span>
<?php endif?>
<?php if(Yii::app()->user->hasFlash('success')):?>
<span class="flash-msg-success">
<?php echo Yii::app()->user->getFlash('success')?>
</span>
 <?php endif ?></span>

			    <?php $this->endWidget(); ?>