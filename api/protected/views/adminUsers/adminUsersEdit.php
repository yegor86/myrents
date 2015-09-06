<?php
$bcArr = array(
    'Пользователи' => '/admin/user/',
    'Редактирование',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'homeLink'=>CHtml::link('Главная','/admin/'),
    'links'=>$bcArr
)); 
 ?>
<table border="0" width="100%" cellpadding="0" height="100%" cellspacing="0"><tr><td width="20%" valign="top" class="left_container">
<?php require 'leftmenu.php';?>
        </td><td width="80%" class="right_container" valign="top">
     <h2>Редактирование пользователя</h2>

     
                        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'edituser',
	'clientOptions'=>array(
	'validateOnSubmit'=>true
	),
)); ?>
            

     
     
            <div style="width:800px;">
                
                     <table border="0" style="position: absolute;right:40px;">
                         <tr>
                             <td>
                                      		    <?php if (file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] .  "userpic/" . $user['image'])) {
                        echo '<span class="avatar"><span class="big_avatar" style="background-image:url(\'/uploads/userpic/'.$user['image'].'\')"></span></span>';
		    } else {
                        echo '<span class="avatar"><span class="big_avatar" style="background-image:url(\'/uploads/userpic/noimage.jpg\')"></span></span>';
		    }
		    ?>
                             </td></tr><tr>
                             <td><?php echo $form->fileField($user, 'image');?></td>
                         </tr>
                     </table>
     <script>
$(function() {
    $('#User_InsertNewpassword').keyup(function(){

        var md5 = $.md5($(this).val());
        $('#User_Newpassword').val(md5);
    });
$('#changepwd').click(function(){
    $('#box_changepwd').slideToggle(0);
    $('#User_Newpassword').val(md5);
    if($('#box_changepwd').({'display':'none'})){
       $('#User_Newpassword').val('0'); 
    }
});
});
        
         </script>
         <div id="User_password_demo">---</div>
                
<div style="width:300px;float:left">
<?php echo $form->label($user, 'firstname'); ?>
</div>
<div style="width:300px;float:right">
<?php echo $form->textField($user, 'firstname');?>
<?php echo $form->error($user, 'firstname'); ?>
</div>
            
<div style="clear:both"></div>
            
<div style="width:300px;float:left">
<?php echo $form->label($user, 'lastname'); ?>
    </div>
<div style="width:300px;float:right">
<?php echo $form->textField($user,'lastname');?>
<?php echo $form->error($user,'lastname'); ?>
</div>


<div style="clear:both"></div>
            
<div style="width:300px;float:left">
<?php echo $form->label($user, 'password'); ?>
    </div>
<div style="width:600px;float:right"><?php echo $user['password'];?> <span id="changepwd"><b>change password</b></span>

<?php echo $form->error($user,'password'); ?>
</div>

<div id="box_changepwd" style="display: none">
<div style="clear:both"></div>
            
<div style="width:300px;float:left">
<?php echo CHtml::label('Новый пароль', 'InsertNewpassword'); ?>
    </div>
<div style="width:300px;float:right">
<?php echo CHtml::textField('User[InsertNewpassword]','');?>
    <?php echo CHtml::hiddenField('User[Newpassword]','');?>
</div>
</div>
            
<div style="clear:both"></div>
            
<div style="width:300px;float:left">
<?php echo $form->label($user, 'email'); ?>
    </div>
<div style="width:300px;float:right">
<?php echo $form->textField($user,'email');?>
<?php echo $form->error($user,'email'); ?>
</div>

<div style="clear:both"></div>
            
<div style="width:300px;float:left">
<?php echo $form->label($user, 'nick'); ?>
    </div>
<div style="width:300px;float:right">
<?php echo $form->textField($user,'nick');?>
<?php echo $form->error($user,'nick'); ?>
</div>

<div style="clear:both"></div>
            
<div style="width:300px;float:left">
<?php echo $form->label($user, 'phone'); ?>
    </div>
<div style="width:300px;float:right">
<?php echo $form->textField($user,'phone');?>
<?php echo $form->error($user,'phone'); ?>
</div>

<div style="clear:both"></div>
            
<div style="width:300px;float:left">
<?php echo $form->label($user, 'skype'); ?>
    </div>
<div style="width:300px;float:right">
<?php echo $form->textField($user,'skype');?>
<?php echo $form->error($user,'skype'); ?>
</div>

<div style="clear:both"></div>

<div style="width:300px;float:left">
<?php echo $form->label($user, 'role'); ?>
    </div>
<div style="width:300px;float:right">
<?php echo $form->dropDownList($user,'role', array('writter'=>'Пользователь', 'moderator'=>'Модератор', 'admin'=>'Админ', 'banned'=>'Забанен'))?>
<?php echo $form->error($user,'role'); ?>
</div>

<div style="clear:both"></div>

<div style="width:300px;float:left">
<?php echo $form->label($user, 'overview'); ?>
    </div>
<div style="width:300px;float:right">
<?php echo $form->textArea($user,'overview');?>
<?php echo $form->error($user,'overview'); ?>
</div>
         <div style="clear:both"></div>   
            <?php echo CHtml::submitButton('Редактировать', array('class'=>'b_yellow'));?>
            </div>
               <?php $this->endWidget(); ?>




            
                </td></tr></table>
