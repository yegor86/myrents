<?php if ($description->overview) { ?>     
                    		<h2 class="stl_2"><?php echo Yii::t('default', 'bill overview') ?>: <?php if($this->curlang->id==2&&$description->language!=2&&$showbutton) {
				 echo CHtml::tag('span', array(),
				 MRChtml::ajaxLink(Yii::t('default','transalate rent overview'), 'javascript:void(0)', array(
				     'update'=>'#rent_overview',
				     'type'=>'post',
				     'url'=>'/rent/translate/'.$rent->id,
                                     'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:50%"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>',
                                     //'append_or_html' => 'append', 
				 )), true);
				    
				    
				}?></h2>
    		<div class="infodesc">
    		    <pre><?php echo $description->overview ?></pre>
    		</div>
<?php } ?>

		    <?php if (count($rent->neighbors)) { ?>
    		<h2 class="stl_2"><?php echo Yii::t('default', 'bill neighborhood') ?>:</h2>

    		<div class="infodesc">
    <?php foreach ($rent->neighbors as $neighbor) { ?>
			    <div class="flt_l" style="width:300px;line-height: 20px">- <?php echo Yii::t('default', $neighbor->name) ?></div>
		    <?php } ?>
    		    <div class="clr"></div>

    		</div>
<?php } ?>

			<?php if (count($rent->amenities)) { ?>
    		<h2 class="stl_2"><?php echo Yii::t('default', 'bill amenities') ?>:</h2>
    		<div class="infodesc">
    		    <div class="addons"> 
			    <?php foreach ($rent->amenities as $amenity) { ?>

				<span title="<?php echo Yii::t('default', $amenity->name); ?>" class="pop icon" style="background-image:url('<?php echo $this->getAssetsUrl() ?>/images/amenities/<?php echo $amenity->image; ?>');" ></span>
		    <?php } ?>
    		    </div>
    		</div><div class="clr"></div>
<?php } ?>
<?php if ($description->rules) { ?>
    		<div class="clr"></div>
    		<div class="rules_box">
    		    <div>
    			<div><?php echo $description->rules ?></div>
    		    </div>
    		</div>
<?php } ?>










