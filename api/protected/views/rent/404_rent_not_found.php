<?php

//SEO block




$this->pageTitle = Yii::t('default','rent.delete.title');

// end SEO Block
?>



<div class="main one">
    <div class="mainhead">
	<div>
	    <div>
		<div></div>
		<table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><?php echo Yii::t('default','rent.delete.title'); ?>
			</td><td><a href="/search/" class="popEdge search_btn flt_r" title="<?php echo Yii::t('default', 'search.button'); ?>"></a></td></tr></table>
	    </div>
	</div>
    </div>
    <div class="content">
        <div class="no_public" style="margin:60px 0 40px;"><div style="">
            <div class="stl_2" style="width:550px;"><?php echo Yii::t('default','rent.delete.text_1'); ?></div>
            <br><br><br>
            <div class="stl_2" style="width:550px;"><?php echo Yii::t('default','rent.delete.text_2'); ?> <a href="/search/"><?php echo Yii::t('default','rent.delete.searchlinktxt'); ?></a> <?php echo Yii::t('default','rent.delete.text_3'); ?></div>
            
            <br><br><br>
            <div style=" margin: 0 auto;width:340px;">
<div class="setlinksz" style="text-align: left;width:200px;float:left;">
    <b class="stl_2"><?php echo Yii::t('default','rent.delete.citylist'); ?></b><br/>
<?php 
$links = $this->createSeoLinks();
foreach ($links as $key=>$value){
    echo CHtml::link($key,$value, array('style'=>'margin-left:10px;line-height:20px;font-size:11px;')).'<br/>';    
}
?>
</div>
                
                <div class="setlinksz" style="text-align: left;width:100px;float:right">
    <b class="stl_2"><?php echo Yii::t('default','rent.delete.rent'); ?></b><br/>

    <a href="/search/" style="margin-left:10px;line-height:20px;font-size:11px;">Дом</a><br/>
    <a href="/search/" style="margin-left:10px;line-height:20px;font-size:11px;">Квартира</a><br/>
    <a href="/search/" style="margin-left:10px;line-height:20px;font-size:11px;">Офис</a><br/>
 
       <br/> <b class="stl_2" ><?php echo Yii::t('default','rent.delete.buy'); ?></b><br/>

    <a href="/search/" style="margin-left:10px;line-height:20px;font-size:11px;">Дом</a><br/>
    <a href="/search/" style="margin-left:10px;line-height:20px;font-size:11px;">Квартира</a><br/>
    <a href="/search/" style="margin-left:10px;line-height:20px;font-size:11px;">Офис</a><br/>
</div>
                
                
                <div class="clr"></div>


        </div></div>




	</div></div>


    </div>
</div>

