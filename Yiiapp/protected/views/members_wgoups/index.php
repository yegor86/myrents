<?php 
$this->pageTitle=Yii::t('default','Members');
?>

<script>
    
    
$(function () {

    $(window).scroll(function () {
        if ($(this).scrollTop() > 192) {
            $('.members_table_head').addClass('fixed');
        } else {
            $('.members_table_head').removeClass('fixed');
        }
    });

});
</script>
    
<div class="main one">
    <div class="mainhead">
        <div>
            <div>
                <div></div>
		<table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><h3 class="flt_l"><?php echo Yii::t('default','Members');?></h3></td></tr></table>
            </div>
        </div>
    </div>
    <div class="content" id="content">
	<?php $this->renderPartial($view,$params) ?>
    </div>
</div>


