<script type="text/javascript">$(function() {$(".flash-alert-success").fadeOut(10000);});</script>
<?php
$this->pageTitle = $user['firstname'] . '  ' . $user['lastname'];
?>

<div class="main one">
    <div class="mainhead">
	<div>
	    <div>
		<div></div>
		<table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><?php echo(Yii::t('default','edit.profile.title')) ?></td><td><a href="/search/" class="search_btn flt_r popEdge" title="<?php echo Yii::t('default','search.button');?>"></a></td></tr></table>
	    </div>
	</div>
    </div>
    <div class="content">
	<ul class="tabs">
	    <li><?php echo CHtml::link(Yii::t('default', 'usermenu.info'), '/user/' . $user->id . '/info') ?></li>
	    <li><?php echo CHtml::link(Yii::t('default', 'usermenu.bills'), '/user/' . $user->id . '/hostings') ?></li>
	    <li><?php echo CHtml::link(Yii::t('default', 'usermenu.favorites'), '/user/' . $user->id . '/favorites') ?></li>
	</ul>
	<div class="tab_content">
	    <table style="width:100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
		    <td class="controller_left_side" valign="top"><ul class="controller_menu">
			    <li><?php echo CHtml::link(Yii::t('default','edit.profile'), "/user/edit") ?></li>
			    <li class="active"><?php echo CHtml::link(Yii::t('default','edit.passwd'), "/user/chpass") ?></li>
			</ul></td>
		    <td class="controller_right_side" valign="top">
			<?php if (Yii::app()->user->hasFlash('error')): ?>
    			<div class="flash-alert-error">
				<?php echo Yii::app()->user->getFlash('error') ?>
    			</div>

			<?php endif ?>
			<?php if (Yii::app()->user->hasFlash('success')): ?>
    			<div class="flash-alert-success">
				<?php echo Yii::app()->user->getFlash('success') ?>
    			</div>
			<?php endif ?>
			<div class="controller_edit">


			    <?php
			    $form = $this->beginWidget('CActiveForm', array(
				'id' => 'user-chpass-form',
				'enableAjaxValidation' => false,
				'htmlOptions' => array('class' => "border_none"),
				    ));
			    ?>
			    <b class="stl_2"><br /><?php echo $form->label($chpassform, 'oldpass'); ?>:</b><br />
			    <div class="input_div">
<?php echo $form->passwordField($chpassform, 'oldpass'); ?>
<?php echo $form->error($chpassform, 'oldpass'); ?>
			    </div>
			    <b class="stl_2"><br /> <?php echo $form->label($chpassform, 'passwd'); ?>:</b><br />
			    <div class="input_div">
<?php echo $form->passwordField($chpassform, 'passwd'); ?>
<?php echo $form->error($chpassform, 'passwd'); ?>
			    </div>
			    <b class="stl_2"><br />        <?php echo $form->label($chpassform, 'confirm'); ?>:</b><br />
			    <div class="input_div">
<?php echo $form->passwordField($chpassform, 'confirm'); ?>
<?php echo $form->error($chpassform, 'confirm'); ?>
			    </div>
			    <div class="mrg_lft_30 mrg_top_20"><?php echo CHtml::link('<span><b><i>' . Yii::t('default', 'save') . '</i></b></span>', 'javascript:void(0)', array('onclick' => 'submitForm ("#user-chpass-form");', 'class' => 'abutton blue')); ?></div><br /><br />
			</div>

<?php $this->endWidget(); ?>
			</div></td>
		</tr>
	    </table>
	</div>
    </div>
</div>





