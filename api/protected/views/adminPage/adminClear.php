<center><?php
if (Yii::app()->user->hasFlash('deleted')) echo Yii::app()->user->getFlash('deleted') ;
echo CHtml::form();
echo CHtml::hiddenField('drop_assets', 'drop_assets');
echo CHtml::submitButton('Удалить assest', array('class'=>'b_red'));
echo CHtml::closeTag('form');
?>
</center>
