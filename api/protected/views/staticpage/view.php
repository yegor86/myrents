<?php
//SEO block

$seo_title = Yii::t('SEO', 'staticpage.title');
$seo_description = Yii::t('SEO', 'staticpage.description');
$seo_keywords = Yii::t('SEO','staticpage.keywords');

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
                <table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><h3 class="flt_l"><?php echo $list->translations[0]->name;?></h3></td></tr></table>


            </div>
        </div>
    </div>
    <div class="content"><div class="tab_content"><div class="help_box">

            <?php 

            
            echo $list->translations[0]->description;
            
            
            ?>
            
            </div>

        </div></div>
</div>