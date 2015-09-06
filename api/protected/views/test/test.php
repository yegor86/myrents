<?php
if (Yii::app()->user->hasFlash('deleted')) echo Yii::app()->user->getFlash('deleted') ;

echo CHtml::form();
echo CHtml::hiddenField('drop_assets', 'drop_assets');
echo CHtml::submitButton('clear assets');
echo CHtml::closeTag('form');
print_r($response);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

