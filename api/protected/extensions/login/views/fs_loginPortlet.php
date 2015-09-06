

<script type="text/javascript">
$(function() {  
    $('#fs_sing_in_form input').keyboard('enter', function(e, bind) {
        ajaxSubmitForm("#fs_sing_in_form", "/wlogin", ".fs_sing_in_block");
        return false;
    });

});
</script>

    <table border="0" class="register_page" cellpadding="0" cellspacing="0" style="z-index:5;position: relative">
    <tr>
        <td width="55%" valign="top" style="border-right: 1px solid #dbdbdb">
	    <div class="fs_sing_in_block">
<?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'fs_sing_in_form',
	'clientOptions'=>array(
	'validateOnSubmit'=>true),

            'htmlOptions'=>array(
	    'OnSubmit'=>'return false;'
	)

)); ?>
                


<table border="0" width="88%">

<?php if(Yii::app()->user->hasFlash('error')){

?>

        <tr>
<td colspan="2" valign="middle"><div style="text-align:center;padding: 27px 0 0 0;color:#c53a23"><b><?php echo Yii::app()->user->getFlash('error')?></b></div><div style="padding: 5px 0 15px 157px;color:#000"><?php echo Yii::t('default','check.passwd.and.login')?></div></td>
          </tr>
 <?php }else{?> 
         <tr>
<td colspan="2" valign="middle"><div style="height:50px;"></div></td>
          </tr>
          
<?php }?>
    <tr>
        <td width="40%" valign="top"><div style="padding-top:10px;padding-left:8px;"><?php echo $form->labelEx($user,'email'); ?></div></td>
        <td width="60%" valign="top"><?php echo $form->error($user,'email'); ?>
		<?php echo $form->textField($user,'email'); ?></td>
    </tr>
    <tr>
        <td valign="top"><div style="padding-top:40px;padding-left:8px;"><?php echo $form->labelEx($user,'password', array('class'=>'required')); ?></div></td>
        <td valign="top"><div style="padding-top:25px;"><?php echo $form->error($user,'password'); ?>
		<?php echo $form->passwordField($user,'password'); ?>
            <small class="exmple"><?php echo Yii::t('default','Your password must be at least 6 characters')?></small>
		<input type="hidden" name="XLoginForm[fs]" value='1'></div></td>
    </tr>
    <tr>
        <td valign="top"></td>
        <td valign="top"><?php if($this->enableRememberMe): ?>

<?php echo CHtml::activeCheckBox($user,'rememberMe', array('id'=>  uniqid('rememberMe'))); ?> <?php echo CHtml::label(Yii::t('default','wgt.XLoginForm.rememberMe'), CHtml::activeId($user, 'rememberMe'), array('class'=>'lab_checkbox'))?><br />
<?php endif; ?><a class="link4" href="/remind" style="display: inline "><?php echo Yii::t('default','forgot.passwd')?>?</a>
        
       <div style="padding: 40px 0 0 0;">
    <?php 
    echo CHtml::link('<span id="btn_sing_id"><b><i>'.Yii::t('default','to.enter').'</i></b></span>','javascript:void(0)',array('onclick'=>'ajaxSubmitForm ("#fs_sing_in_form", "/wlogin", ".fs_sing_in_block");','class'=>'btn_border abutton blue'));
    ?>  
</div>
        
        </td>
    </tr>
</table>

                <br/><br/>





<?php $this->endWidget(); ?>
	    
            </div>
        </td>
        <td width="45%" valign="top" style="border-left: 1px solid #fff">
        
        <table border="0" class="table_box sing" cellpadding="0" cellspacing="0">
  <tr>
    <td><h2 class="title"><?php echo Yii::t('default','Sign in using')?></h2></td>
  </tr>

  <tr>

      
      <td class="right">
	  
	  <?php Yii::app()->eauth->renderWidget(array('view'=>'big')); ?>  
	      
	  
      </td>
  </tr>

</table>
            <div class="hint" style="width:330px; padding-left: 30px;"><?php echo Yii::t('default','singin.info')?>

</div>
        <td>
    </tr>
</table>


