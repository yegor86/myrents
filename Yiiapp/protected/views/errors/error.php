


<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('default','error').' - '.$code;
?>

<div class="main one">
    <div class="mainhead">
        <div>
            <div>
                <div></div>
                <table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><h3 class="flt_l"><?php echo Yii::t('default','error');?> <?php echo $code; ?>:</h3></td></tr></table>


            </div>
        </div>
    </div>
    <div class="content" style="padding:50px 0;">
            
                <div class="no_component"><b class="stl_2"><?php echo CHtml::encode($message); ?></b></div>
        </div>
</div>
    