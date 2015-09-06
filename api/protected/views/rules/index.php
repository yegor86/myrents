<?php
//SEO block

$seo_title = Yii::t('SEO', 'rules.title');
$seo_description = Yii::t('SEO', 'rules.description');
$seo_keywords = Yii::t('SEO','rules.keywords');

$this->pageTitle = $seo_title;
Yii::app()->clientScript->registerMetaTag($seo_description, 'description');
Yii::app()->clientScript->registerMetaTag($seo_keywords, 'keywords');

// end SEO Block
?>

<div class="main one">
    <div class="mainhead">
        <div>
            <div>
                <div></div>
		<table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><h3 class="flt_l"><?php echo Yii::t('default','Rules');?></h3></td></tr></table>


            </div>
        </div>
    </div>
    <div class="content"><div class="tab_content pdd_10">
MyRents
        </div></div>
</div>


