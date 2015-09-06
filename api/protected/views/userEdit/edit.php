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
            <li><?php echo CHtml::link(Yii::t('default', 'usermenu.messages'), '/user/' . $user->id . '/messages') ?></li>
	    <li><?php echo CHtml::link(Yii::t('default', 'usermenu.bills'), '/user/' . $user->id . '/hostings') ?></li>
	    <li><?php echo CHtml::link(Yii::t('default', 'usermenu.favorites'), '/user/' . $user->id . '/favorites') ?></li>
	</ul>
	<div class="tab_content">
	    <table style="width:100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
		    <td class="controller_left_side" valign="top"><ul class="controller_menu">
			    <li class="active"><?php echo CHtml::link(Yii::t('default','edit.profile'), "/user/edit") ?></li>
			    
			    <?php if ($user->service=='local') {?>
			    <li><?php echo CHtml::link(Yii::t('default','edit.passwd'), "/user/chpass") ?></li>
			    <?php }?>
			</ul></td>
		    <td class="controller_right_side" valign="top">
                        
<script type="text/javascript">
$(function() {  
    $('#edit-form input').keyboard('enter', function(e, bind) {
        submitForm ("#edit-form");
        return false;
    });
});
</script>

<?php if(Yii::app()->user->hasFlash('error')):?>
<div class="flash-alert-error">
<?php echo Yii::app()->user->getFlash('error')?>
</div>

<?php endif?>
<?php if(Yii::app()->user->hasFlash('success')):?>
<div class="flash-alert-success">
<?php echo Yii::app()->user->getFlash('success')?>
</div>
 <?php endif ?>
			<div class="controller_edit">
<?php if(Yii::app()->user->hasFlash('error')):?>
<div class="flash-alert-error">
<?php echo Yii::app()->user->getFlash('error')?>
</div>
<?php endif?>
<?php if(Yii::app()->user->hasFlash('success')):?>
<div class="flash-alert-success">
<?php echo Yii::app()->user->getFlash('success')?>
</div>
<?php endif?>
			    <?php
			    $form = $this->beginWidget('CActiveForm', array(
				'id' => 'edit-form',
				'clientOptions' => array(
				    'validateOnSubmit' => true,
				),
				'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => "border_none",'name'=>'UserFormEdit'),
				    ));
			    ?>       
                            <div class="edit_profile_avatar">
                                                                 <?php echo '<div class="avatar flt_l" style="width:260px;"><span class="big_avatar" style="background-image:url(/uploads/userpic/'.$user['image'].'?'.rand(0, 1000).')"></span></div>';?>
                                <div class="info flt_l">
				    <?php echo Yii::t('default','user.edit.image.formats');?>
                                    				<?php
				//if (preg_match("/(Firefox(?:\/|\s)3.6)/i", $_SERVER['HTTP_USER_AGENT'])) {
                                    echo '<div class="file_old">';
                                    echo $form->error($editform, 'image');
				  //  echo $form->fileField($editform, 'image', array('id' => 'newfile', 'onchange' => 'document.getElementById(\'selectedfile\').style.display=\'\';document.getElementById(\'selectedfile\').innerHTML=this.value'));
                                    echo $form->fileField($editform, 'image', array('id' => 'newfile'));
				    ?><br /><br /><div class="display_in_block"><a class="abutton blue" href="javascript:void(0)" onclick="$('#edit-form').submit();"><span><b><i><?php echo Yii::t('default', 'upload') ?></i></b></span></a></div>
                                   <?php echo '</div>';
				//} else {
				    ?>
    				<!--<center>
    				    <div  style="height:20px;" id="selectedfile"></div>
    				    <div class="display_in_block"><a class="abutton blue" href="javascript:void(0)" onclick="$('#newfile').click();"><span><b><i><?php echo Yii::t('default', 'Выбрать файл') ?></i></b></span></a></div>
    				</center>-->
				    <?php //echo $form->fileField($editform, 'image', array('id' => 'newfile', 'style' => "visibility: hidden", 'onchange' => 'document.getElementById(\'selectedfile\').style.display=\'\';document.getElementById(\'selectedfile\').innerHTML=this.value;document.UserFormEdit.submit()')); ?>
				    <?php //echo $form->error($editform, 'image'); ?>
				<?php //} ?> 
                                    
                                    
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/crop_photo.php" class="crop_photo fancybox.ajax row" style="display:none">Редактировать фотографию</a>
                                </div>
                            <div class="clr"></div></div>
                            
			    <div class="edit_profile_info">


				<b class="stl_2"><br /><?php echo $form->label($editform, 'firstname'); ?>:</b><br />
				<div class="input_div">
				    <?php echo $form->textField($editform, 'firstname'); ?>
				    <?php echo $form->error($editform, 'firstname'); ?>
				</div>
				<div class="hint"><?php echo Yii::t('default','user.edit.firstname.length')?></div>
				<b class="stl_2"><?php echo $form->labelEx($editform, 'lastname'); ?>:</b><br />
				<div>
				    <?php echo $form->textField($editform, 'lastname'); ?>
				    <?php echo $form->error($editform, 'lastname'); ?></div>

				

				<?php echo CHtml::link('<span><b><i>'.Yii::t('default', 'save').'</i></b></span>', 'javascript:void(0)', array('onclick' => 'submitForm ("#edit-form");', 'class' => 'abutton blue mrg_lft_30 mrg_bottom_20 mrg_top_20')); ?>

			
                                <script type="text/javascript">
                                    $('.crop_photo').fancybox({
            'autoDimensions'	: true,
            'padding'		: 10,
            'height'        	: 'auto',
			'width'        	: '1000',
            'transitionIn'	: 'none',
			'autoScale':true,
			'centerOnScroll':false,
			'margin':10,
            'scrolling'		: 'no'
                                    }); 

                                </script>
			    </div>


			    <?php $this->endWidget(); ?>
<?php if($user->service =='local'){?>
                                            <div class="border_top">

                  <b class="stl_2"><?php echo Yii::t('default','Email');?>:</b><br /><br />
                  
                    
                    <strong class="pdd_30"><?php echo $user->email?></strong>
                    <pre><?php echo Yii::t('default','edit.user.your.email.hint');?></pre></div>
                            
                            <?php }?>
			    
			    <?php $this->widget('ext.widgets.userEdit.PhonesEditorWidget.PhonesEditorWidget', array('user'=>$user)) ;?>
			    <?php $this->widget('ext.widgets.userEdit.SkypeEditWidget.SkypeEditWidget', array('user'=>$user)) ;?> 
			<?php $this->widget('ext.widgets.userEdit.UserDescriptionEditWidget.UserDescriptionEditWidget', array('user'=>$user)) ;?>
			   
			    
			    <div id="langsResult">
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
    echo CHtml::link('<span><b><i>'.Yii::t('default', 'save').'</i></b></span>','javascript:void(0)',array('onclick'=>'ajaxSubmitForm("#editLangForm","/user/edit","#langsResult","load_box_lang")','class'=>'abutton blue'));
    ?></div> <span id="load_box_lang" style="display:none"><img src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt=""></span>

			    
			    <?php $this->endWidget(); ?>
</div>
			</div></td>
		</tr>
	    </table>
	</div>
    </div>
</div>
