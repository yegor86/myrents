<div id="full_container"><?php
$bcArr = array(
    'Рассылка'
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'homeLink'=>CHtml::link('Главная','/admin/'),
    'links'=>$bcArr
)); 
 ?>   


<table border="0" width="100%" cellpadding="0" height="100%" cellspacing="0"><tr><td class="center_container" valign="top">
            <h2>Рассылка</h2>


<?php if($status=='disabled') {?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>  
<?php echo $form->fileField($model,'mailfile');?>
 
<?php echo CHtml::submitButton('загрузить', array('class'=>'b_green','style'=>'margin-left:10px;'))?>
<?php $this->endWidget(); ?>
<?php if (!$file_exists){?>
Файл не загружен, вы не можете начать рассылку
<?php } else {?>
Файл уже загружен<br>
Вы можете загрузить другой, или начать рассылку
<form method="POST"><br/>
    <input type="submit" value="начать рассылку" name="send" class="b_green">
</form>
<br>
<?php }?>
<?php } elseif($status=='stopping') {?>
остановка рассылки
<?php } elseif($status=='queue') {?>
поставлено в очередь
<?php } elseif($status=='progress') {?>
Идёт рассылка<br>
<?php }?>
<?php if($status=='progress'||$status=='queue') {?>
<?php echo $progress ?><br>
<!--вы можете прервать текущую рассылку:
<form method="POST">
    <input type="submit" value="Прервать" name ="decline">
</form>-->
<?php }?>




    </td></tr></table></div>










