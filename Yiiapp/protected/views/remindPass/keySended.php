<?php

$this->pageTitle = Yii::t('default', 'remid.title');

?>


<div class="main one">
    <div class="mainhead">
	<div>
	    <div>
		<div></div>
		<table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><?php echo Yii::t('default', 'remid.title') ?>
		
                        </td><td><a href="/search/" class="search_btn flt_r popEdge" title="<?php echo Yii::t('default', 'search.button'); ?>"></a></td></tr></table>
	    </div>
	</div>
    </div>
    <div class="content">


        
        
        
        
        
        
        <?php if(Yii::app()->user->hasFlash('success')){?>
<div class="flash-alert-success">
<?php echo Yii::t('default',Yii::app()->user->getFlash('success'))?>
</div>
<?php }    ?>
        
<div id="support_box_popup" style="border:0;margin-left: 120px;">

<?php
echo CHtml::script('  if (!!(window.history && history.replaceState)) history.replaceState(null, null, "' . $this->createAbsoluteUrl("/") . ');' );
?>

    <br/>
    <br/>

</div>

    </div>
    
</div>




    


    
