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
                             <td><?php //echo $form->fileField($user, 'image');?></td>
                         </tr>
                     </table>
                <table border="0" width="100%" cellpadding="3" cellspacing="2">
                    <tr>
                        <td width="40%" align="right"><?php echo $form->labelEx($user, 'firstname'); ?>:</td>
                        <td width="60%"><?php echo $form->textField($user, 'firstname'); ?><?php echo $form->error($user, 'firstname'); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><?php echo $form->labelEx($user, 'lastname'); ?>:</td>
                        <td><?php echo $form->textField($user, 'lastname'); ?><?php echo $form->error($user, 'lastname'); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><?php echo $form->labelEx($user, 'email'); ?>:</td>
                        <td><?php echo $form->textField($user, 'email'); ?><?php echo $form->error($user, 'email'); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><?php echo $form->labelEx($user, 'nick'); ?>:</td>
                        <td><?php echo $form->textField($user, 'nick'); ?><?php echo $form->error($user, 'nick'); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><?php echo $form->labelEx($user, 'phone'); ?>:</td>
                        <td><?php echo $form->textField($user, 'phone'); ?><?php echo $form->error($user, 'phone'); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><?php echo $form->labelEx($user, 'skype'); ?>:</td>
                        <td><?php echo $form->textField($user, 'skype'); ?><?php echo $form->error($user, 'skype'); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><?php echo $form->labelEx($user, 'role'); ?>:</td>
                        <td><?php echo $form->dropDownList($user,'role', array('writter'=>'Пользователь', 'moderator'=>'Модератор', 'admin'=>'Админ', 'banned'=>'Забанен'))?><?php echo $form->error($user, 'role'); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><?php echo $form->labelEx($user, 'overview'); ?>:</td>
                        <td><?php echo $form->textArea($user,'overview');?><?php echo $form->error($user, 'overview'); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a id="change_password" href="javascript:void(0)">изменить пароль</a></td>
                    </tr>
                    <tr id="new_password" class="none">
                        <td align="right"><label for="User_new_password">Новый пароль:</label></td>
                        <td><input type="text" name="User[new_password]" id="User_new_password" /></td>
                    </tr>
                    <tr>
                        <td align="right"><?php echo $form->labelEx($user, 'active'); ?>:</td>
                        <td><?php echo $form->checkBox($user,'active');?><?php echo $form->error($user, 'active'); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?php echo CHtml::submitButton('Сохранить', array('class' => 'b_green')); ?></td>
                    </tr>
                </table>

            
                </td></tr></table>

               <?php $this->endWidget(); ?>
                <script>
                    $(function(){
                        $("#change_password").click(function () {
                            $("#new_password").slideToggle(0);
                        });
                    });  
                </script>