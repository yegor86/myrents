<div class="main one">
    <div class="mainhead">
        <div>
            <div>
                <div></div>
		<table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><h3 class="flt_l"><?php echo Yii::t('default','API');?></h3></td></tr></table>


            </div>
        </div>
    </div>
    <div class="content"><?php include'_apimenu.php';?><div class="tab_content pdd_10">
                              
                              
                              
                                  <?php
	 $form=$this->beginWidget('CActiveForm', array(
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),        'htmlOptions'=>array('name'=>'execForm','enctype' => 'multipart/form-data')
	     )); 
	 
	 $errors = $fileform->getErrors();
	
	 if(count($errors)) foreach ($errors as $error){
	     echo $error[0].'<br>';
	     
	 }
	 
    echo $form->label($fileform, 'url');
    echo $form->textField($fileform,'url');
    
    echo '<br>';
    
    echo $form->label($fileform, 'file');
    echo $form->fileField($fileform,'file');



    $this->endWidget(); 

    echo CHtml::link('<span><b><i>Execute</i></b></span>','javascript:void(0)',
	array('onclick'=>'document.execForm.submit()','class'=>'abutton blue')
	);

?>
             
                              
 
            <br/>
            <br/>
            <br/>
            <br/><br/>
            <br/>
            <br/>
            <br/>
            <br/>

        </div></div>
</div>



    
    




