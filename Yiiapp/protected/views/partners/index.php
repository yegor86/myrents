<?php 
$this->pageTitle=Yii::t('default','Partners');
?>


<div class="main one">
    <div class="mainhead">
        <div>
            <div>
                <div></div>
		<table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><h3 class="flt_l"><?php echo Yii::t('default','Partners');?></h3></td></tr></table>


            </div>
        </div>
    </div>
    <div class="content"><div class="tab_content pdd_10 partners">
            <table border="0" cellpadding="5" cellspacing="5" width="100%">
                
                                <?php if(count($partnerlist)){?>
                <?php foreach ($partnerlist as $partner) { ?>
                    <?php foreach ($partner['translations'] as $trans) { ?>

                <tr>
                    <td width="15%"><a target="_blank" href="http://<?php echo $partner->url?>"><img src="/uploads/partners/<?php echo $partner->image?>" width="140" height="90" alt="" border="0" /></a></td>
                    <td width="85%"><a target="_blank" href="http://<?php echo $partner->url?>"><b><?php echo $partner->url?></b></a><p><?php echo $trans->description ?></p></td>
                </tr>
                    <?php } ?>
                <?php } ?>
                        <?php } ?>
                        

            </table>
        </div></div>
</div>


