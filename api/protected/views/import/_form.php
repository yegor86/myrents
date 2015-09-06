<?php
if($completed) echo 'completed';
    else{?>
    Обработано: <?php echo $formModel->start?> из <?php echo $count ?>
<?php
	 $form=$this->beginWidget('CActiveForm', array(
	'id'=>'exec-form',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	))); 
	 

    echo $form->hiddenField($formModel,'start');
    
    
    $this->endWidget(); 
?>


<?php echo CHtml::link('<span><b><i>Execute</i></b></span>','javascript:void(0)',
	array('onclick'=>'ajaxSubmitForm ("#exec-form", "'.$url.'", "#result", false);','class'=>'abutton blue')
	);


if($reload) echo '<script>ajaxSubmitForm ("#exec-form", "'.$url.'", "#result", false);</script>';
?>

<?php }?>