<?php $viewdescription = (isset($rent->descriptions[0]))?$rent->descriptions[0]:RentDescription::model()->findByPk(array('rent'=>$rent->id,'language'=>1)); 
$this->pageTitle=$viewdescription->name;
?>
<script type="text/javascript">$(function() {$(".flash-alert-success").fadeOut(10000);});</script>

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

	<div class="tab_content">
	    <table style="width:100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
		    <td class="controller_left_side" valign="top">
<?php $this->widget('ext.widgets.editRentMenuWidget.editRentMenuWidget',array('rentid' => $rent->id,'active' => 'drop'));?>
		    </td>
		    <td class="controller_right_side" valign="top">
			<div class="controller_edit" id="returnform">
                            				    <?php if (Yii::app()->user->hasFlash('error')): ?>
    				    <div class="flash-alert-error">
					    <?php echo Yii::app()->user->getFlash('error') ?>
    				    </div>
    				    <script type="text/javascript">hasChange = true;</script>
				    <?php endif ?>
				    <?php if (Yii::app()->user->hasFlash('success')): ?>
    				    <div class="flash-alert-success">
					    <?php echo Yii::app()->user->getFlash('success') ?>
    				    </div>
    				    <script type="text/javascript">hasChange = false;</script>
				    <?php endif ?>
			    <div class="controller_pdd">
				<?php
				$form = $this->beginWidget('CActiveForm', array(
				    'id' => 'droprent',
				    'clientOptions' => array(
					'validateOnSubmit' => true,
				    ),
				    'htmlOptions' => array('name' => 'droprent')
					));
				?>      <input type="hidden" value="" name="newdoc" id="newdoc">

				<?php echo CHtml::hiddenField('dropRent', true) ?>
				<div class="clr"></div>
			    <?php $this->endWidget(); ?>



                                <br/><br/><br/><br/><br/>
<div class="no_public"><?php echo Yii::t('default','drop bill warning');?>
<div class="pdd_20">
<?php
echo CHtml::link('<span><b><i>' . Yii::t('default','&nbsp;&nbsp;&nbsp;Drop&nbsp;&nbsp;&nbsp;') . '</i></b></span>', 'javascript:void(0)', array('onclick' => 'popup_droprent(\''.Yii::t('default','Да').'\', \''.Yii::t('default','Нет').'\', \''.Yii::t('default','Удалить объявление').'\');', 'class' => ' abutton blue'));
?>
</div>
</div>
                                <div style="padding:90px;"></div>
			    </div>
			</div>
		    </td>
		</tr>
	    </table>
	</div>
    </div>
</div>