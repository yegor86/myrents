<?php
$description = (isset($rent->descriptions[0])) ? $rent->descriptions[0] : RentDescription::model()->findByPk(array('rent' => $rent->id, 'language' => 1));
if (!$description)
    $description = new RentDescription ();
?>


<?php
//SEO block

$seo_params = array(
    '{type}' => Yii::t('SEO', $rent->rent_type->name),
    '{todo}' => Yii::t('SEO', $rent->rent_todo->name),
    '{room_count}' => $rent->rooms_count,
    '{floor}' => $rent->floor,
    '{square}' => $rent->square,
    '{name}' => $description->name,
    '{adress}' => isset($rent->adress->name) ? $rent->adress->name : ''
);



$seo_title = Yii::t('SEO', 'seo.rent.titile.' . $rent->rent_type->name, $seo_params);
$seo_description = Yii::t('SEO', 'seo.rent.description.' . $rent->rent_type->name, $seo_params);


$this->pageTitle = $seo_title;
Yii::app()->clientScript->registerMetaTag($seo_description, 'description');
Yii::app()->clientScript->registerMetaTag($this->toKeywords($seo_title), 'keywords');

// end SEO Block
?>



<img style="display: none" src="<?php echo $this->assetsUrl ?>/images/map-indi.png" id="flat_indicator">

<div class="main one">
    <div class="mainhead">
	<div>
	    <div>
		<div></div>
		<table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><?php echo preg_replace('/([\,\.])(?!\s)/ui', '$1 ', $description->name) ?>



<?php if ($this->user && $this->user->active) { ?>
    			    <span id="favorite">
				    <?php if (!array_key_exists($rent->id, $favorites)) { ?>


	<?php echo MRChtml::ajaxLink('', '/addfav', array('update' => '#favorite', 'preloadImage' => '<img src="' . $this->getAssetsUrl() . '/images/s-loading.gif" border="0" alt="">', 'append_or_html' => 'html', 'data' => array('id' => $rent->id), 'type' => 'post'), array('class' => 'popEdge addfav', 'title' => Yii::t('default', 'add to favorites'))) ?>

				    <?php } else { ?>
					<span class="popEdge alreadyfav" title="<?php echo Yii::t('default', 'added to favorites') ?>"></span>

    <?php } ?>
    			    </span>
<?php } ?>
			</td><td><a href="/search/" class="popEdge search_btn flt_r" title="<?php echo Yii::t('default', 'search.button'); ?>"></a></td></tr></table>
	    </div>
	</div>
    </div>
    <div class="content">
	<div id="tabs">
	    <ul>
		<li><a href="#photos"><?php echo Yii::t('default', 'Photos') ?></a></li>
		<li><a href="#maps"><?php echo Yii::t('default', 'Maps') ?></a></li>
		<li style="display:none"><a href="#streetview"><?php echo Yii::t('default', 'Street view') ?></a></li>
		<li style="display:none;"><a href="#calendar"><?php echo Yii::t('default', 'Calendar') ?></a></li>
	    </ul>
	    <div class="profile_box tab_content">
		<div id="photos">
		    <div class="flt_l">
<?php if (count($rent->photos) == true) { ?>
    			<script type="text/javascript">
    			    jQuery(function($) {

    				var galleries = $('.ad-gallery').adGallery();

    			    });
    			</script>

    			<div id="gallery" class="ad-gallery">
    			    <div class="ad-image-wrapper">
    			    </div>
    			    <div class="ad-nav">
    				<div class="ad-thumbs">
    				    <ul class="ad-thumb-list">
					    <?php foreach ($rent->photos as $photo) { ?>
	<?php $img = CHtml::image('/uploads/rentpic/' . $rent->id . '/thumbs/' . $photo->file); ?>
						<li><?php echo CHtml::link($img, '/uploads/rentpic/' . $rent->id . '/' . $photo->file); ?></li>
    <?php } ?>
    				    </ul>
    				</div>
    			    </div>
    			</div>
			<?php } else { ?>
    			<div class="no_gallery_box"><span><?php echo Yii::t('default', 'no photos') ?></span></div>

<?php } ?>




		    </div>
		</div>
		<div id="maps">
		    <div class="user_box_tab_content">
			<?php if ($rent->adress) { ?>
    			<div id="YMapsID" style="width:656px;height:530px"></div>
			<script>
			    api.addMap('YMapsID');
			    api.setCenteredMark({
			    geoY:<?php echo $rent->adress->geoy ?>,
			    geoX:<?php echo $rent->adress->geox ?>,
			    title: '<?php echo $description->name ?>'
			});
			</script>
    			
<?php } ?>
		    </div>
		</div>
		<div id="streetview">
		    <div class="user_box_tab_content"></div>
		</div>
		<div id="calendar">
		    <div class="user_box_tab_content">

			<div class="clendar_box" style="margin-top: 16px;">
			    <!--     <div align="right">
	     <form action="" method="post">
	     Select price type:
	     <select>
	     <option>Per day</option>
	     <option>Per month</option>
	     </select>
	     <span  class="mrg_lft_30">Select month:</span>
	     <select>
	     <option>Январь</option>
	     <option>Февраль</option>
	     <option>Март</option>
	     <option>Апрель</option>
	     <option>Май</option>
	     <option>Июнь</option>
	     <option>Июль</option>
	     <option>Август</option>
	     <option>Сентябрь</option>
	     <option>Ноябрь</option>
	     <option>Декабрь</option>
	     </select>
	     
	     <span  class="mrg_lft_30">Select Year:</span>
	     <select>
	     <option>2012</option>
	     <option>2011</option>
	     <option>2010</option>
	     <option>2009</option>
	     <option>2008</option>
	     
	     </select>
	     </form></div>
	     <br />
	     <table border="0" cellspacing="1" cellpadding="1" class="calendar_week" width="100%">
	     <tr>
	     <td>Mondey</td>
	     <td>Tuesday</td>
	     <td>Wednesday</td>
	     <td>Thursday</td>
	     <td>Friday</td>
	     <td>Saturday</td>
	     <td>Sunday</td>
	     </tr>
	     </table>
	     <table border="0" cellspacing="1" cellpadding="1" class="calendar">
	     
	     <tr>
	     <td class="day">1</td>
	     <td class="day">2</td>
	     <td class="day">3</td>
	     <td class="day_select">4 <b>$16</b></td>
	     <td class="day_select">5 <b>$16</b></td>
	     <td class="day_select">6 <b>$16</b></td>
	     <td class="day_select">7 <b>$16</b></td>
	     </tr>
	     <tr>
	     <td class="day_select">8 <b>$16</b></td>
	     <td class="day">9</td>
	     <td class="day">10</td>
	     <td class="day">11</td>
	     <td class="day">12</td>
	     <td class="day">13</td>
	     <td class="day">14</td>
	     </tr>
	     <tr>
	     <td class="day_select">15 <b>$16</b></td>
	     <td class="day">16</td>
	     <td class="day">17</td>
	     <td class="day">18</td>
	     <td class="day">19</td>
	     <td class="day">20</td>
	     <td class="day">21</td>
	     </tr>
	     <tr>
	     <td class="day_select">22 <b>$16</b></td>
	     <td class="day">23</td>
	     <td class="day">24</td>
	     <td class="day">25</td>
	     <td class="day">26</td>
	     <td class="day">27</td>
	     <td class="day">28</td>
	     </tr>
	     <tr>
	     <td class="day_select">29 <b>$16</b></td>
	     <td class="day">30</td>
	     <td class="day">31</td>
	     <td class="day_empty"></td>
	     <td class="day_empty"></td>
	     <td class="day_empty"></td>
	     <td class="day_empty"></td>
	     </tr>
	     </table>
	     <div class="flt_r">
	     <span class="available">Available</span>
	     <span class="unavailable">Unavailable</span>
	     </div>
			    -->В разработке
			</div>
		    </div>
		</div>
		<div class="profile_user_avatar flt_r" style="height: 500px;">
		    <table border="0" cellpadding="0" cellspacing="0" style="height:100%"><tr><td valign="top">
				    <?php
				    echo CHtml::link('<span class="avatar"><span class="big_avatar" style="background-image:url(\'/uploads/userpic/' . $rent['renter']['image'] . '\')"></span></span>', '/user/' . $rent['user']);
				    ?>
				<div><br/>
				    <?php echo CHtml::link($rent['renter']['firstname'] . ' ' . $rent['renter']['lastname'], '/user/' . $rent['renter']['id'], array('class' => 'link')) ?></div><br />

				<dl>
				    <?php if ($rent['renter']['phone']) { ?>
    				    <dt><?php echo Yii::t('default', 'Phone') ?>:</dt>
    				    <dd><?php echo CustomFunctions::slashNtoBR($rent['renter']['phone']) ?></dd>
				    <?php } ?>
				    <?php if ($rent['renter']['skype']) { ?>
    				    <dt><?php echo Yii::t('default', 'Skype') ?>:</dt>
    				    <dd><?php echo $rent['renter']['skype'] ?></dd>
				    <?php } ?>
				    <?php if ($rent['renter']['email']) { ?>
    				    <dt><?php echo Yii::t('default', 'E-mail') ?>:</dt>
    				    <dd><?php echo CHtml::link($rent['renter']['email'], 'mailto:' . $rent['renter']['email']); ?></dd>
<?php } ?>
				</dl>
			    </td></tr><tr>
			    <td valign="bottom"><?php if (!Yii::app()->user->isGuest) {?><a class="btn_border abutton yellow" href="/user/<?php echo Yii::app()->user->id?>/messages/send/<?php echo $rent['renter']['id']?>" ><span><b><i><?php echo Yii::t('default', 'Send message') ?></i></b></span></a><?php }else{?><a class="btn_border abutton yellow" href="/login" ><span><b><i><?php echo Yii::t('default', 'Send message') ?></i></b></span></a><?php }?>
			    </td>
			</tr>
		    </table>
		</div>
		<div class="clr"></div>
	    </div>


	</div>



	<div class="flt_l i_left">
	    <a href="javascript:void(0)"  onclick ="$('#tabs').tabs( 'select' , '#maps' )" class="address_link"><?php if ($rent->adress) {
		    if(Yii::app()->language=='en'&&$rent->adress->name_en) echo $rent->adress->name_en;
		    else    echo $rent->adress->name ;
		}
		 ?></a>   

	    <div style="margin:0 10px 0 10px;" id="rent_overview">

	    <?php $this->renderPartial('/rentTranslate/_rent_overview', array('description' => $description, 'rent' => $rent,'showbutton'=>$showbutton)) ?>
	    </div>
                                        <table border="0" width="100%" cellpadding="0" cellspacing="0" style="margin-top:20px;margin-left:20px;">
                    <tr>
                        <td width="20%"><!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-size="medium"></div>

<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script></td>
                        <td width="30%"><!-- Put this script tag to the place, where the Share button will be -->
<script type="text/javascript"><!--
document.write(VK.Share.button({url: "http://myrents.com.ua/rent/<?php echo $rent->id?>"},{type: "round", text: "Поделиться"}));
--></script></td>
                        <td width="25%">

<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></td>
                        <td width="25%"><div class="fb-like" data-href="http://myrents.com.ua/rent/<?php echo $rent->id?>" data-send="false" data-layout="button_count" data-width="200" data-show-faces="true" data-font="arial"></div></td>
                    </tr>
                </table>
	    <div class="pdd_10"></div>
	    <ul class="tabs">

		<li class="active"><span><?php echo Yii::t('default', 'bill comments'); ?><?php if (count($commentsList['comments'])) echo ':' . count($commentsList['comments']) ?></span></li>
	    </ul>
	    <div class="clr"></div>

	    <div class="comment_box" id="commenstlist">
<?php require '_rentcomment.php' ?>
	    </div>    
	                    
        </div>



	<div class="flt_r i_right">
<?php if ($rent->todo == 1) { ?>
    	    <div class="uprice">
    <?php echo number_format($rent->$prices[$rent->current_price]['row'] * $rent->currency->rate  / $this->currentCurrency->rate,0,',',' ') ?> <?php echo Yii::t('default', $this->currentCurrency->short_name) ?>
    		<div><?php echo Yii::t('default', $prices[$rent->current_price]['row']); ?></div>
    	    </div>
    	    <div class="amenities">

    <?php foreach ($prices as $price)
	if ($rent->$price['row']) { ?>
	    		<div class="dashed">
	    		    <div class="flt_l"><?php echo Yii::t('default', $price['row']); ?>:</div>
	    		    <div class="flt_r"><?php echo number_format($rent->$price['row'] * $rent->currency->rate  / $this->currentCurrency->rate,0,',',' ') ?> <?php echo Yii::t('default', $this->currentCurrency->short_name) ?></div>
	    		</div>	
			<?php } ?>

    	    </div>
	    <?php } else { ?>
    	    <div class="uprice">
    <?php echo number_format($rent->price_day * $rent->currency->rate  / $this->currentCurrency->rate,0,',',' ') ?> <?php echo Yii::t('default', $this->currentCurrency->short_name) ?>
    	    </div>
<?php } ?>


	    <div class="amenities">
		<div class="dashed">
		    <div class="flt_l"><?php echo Yii::t('default', 'bill type') ?>:</div>
		    <div class="flt_r"><?php echo Yii::t('default', $rent['rent_type']['name']) ?></div>
		</div>
		<div class="dashed">
		    <div class="flt_l"><?php echo Yii::t('default', 'bill floor') ?>:</div>
		    <div class="flt_r"><?php echo Yii::app()->params['floors_to_edit'][$rent->floor] ?></div>

		</div>
		<div class="dashed">
		    <div class="flt_l"><?php echo Yii::t('default', 'bill rooms count') ?>:</div>
		    <div class="flt_r"><?php echo Yii::app()->params['rooms'][$rent->rooms_count] ?></div>
		</div>
		<div class="dashed">
		    <div class="flt_l"><?php echo Yii::t('default', 'bill square (m2)') ?>:</div>
		    <div class="flt_r"><?php echo $rent['square'] ?></div>
		</div>
            <div class="dashed"><?php $dataformat = (Yii::app()->language =='en')?"Y-m-d":"d.m.Y" ?>
		<div class="flt_l"><b><?php echo Yii::t('default', 'bill create date') ?>:</b></div>
		<div class="flt_r"><?php echo date($dataformat,  strtotime($rent->creation_date))?></div>
	    </div>
            <div class="dashed">
		<div class="flt_l"><b><?php echo Yii::t('default', 'bill update date') ?>:</b></div>
		<div class="flt_r"><?php echo date($dataformat,  strtotime($rent->last_up)) ?></div>
	    </div>

	    </div>

<?php if (count($similarRents)) { ?>
    	    <ul class="tabs">

    		<li class="active"><span><?php echo Yii::t('default', 'bill similar') ?></span></li>

    	    </ul>
    	    <div class="clr"></div>
    	    <div class="brdr">
    		<div class="brdrline"></div>
    		<div class="scroll-pane">
				<?php
				foreach ($similarRents as $key => $similarRent) {
				    $similardescription = (isset($similarRent['rent']->descriptions[0])) ? $similarRent['rent']->descriptions[0] : RentDescription::model()->findByPk(array('rent' => $similarRent['rent']->id, 'language' => 1));
				    ?>
			    <div class="scroll_box">
				<div class="flt_l clr">
				    <?php echo '<a href="/rent/' . $similarRent['rent']->id . '"><span class="similar_img" style="background-image: url(\'/uploads/rentpic/' . $similarRent['rent']->id . '/thumbs/' . $similarRent['rent']->photos[0]->file . '\')"></span></a>'; ?>

				</div>

				<div class="flt_r"><div class="trans"><a href="/rent/<?php echo $similarRent['rent']->id; ?>" class="link3"><?php echo $similardescription->name; ?></a><div class="trans_txt"></div><div class="clr"></div></div>
					    <?php if ($similarRent['rent']->todo == 1) { ?>
	    			    <div class="price" style="padding-top:20px"><b><?php echo Yii::t('default', $this->currentCurrency->short_name)?> 
					<?php
					echo round($similarRent['rent']->
						$prices[$similarRent['rent']->current_price]['row'] /
						$this->currentCurrency->rate)
					?></b>
	    <?php echo Yii::t('default', $prices[$similarRent['rent']->current_price]['row']); ?></div>
	<?php } else { ?>
	    			    <div class="price" style="padding-top:20px"><b><?php echo Yii::t('default', $this->currentCurrency->short_name)?> <?php echo round($similarRent['rent']->price_day / $this->currentCurrency->rate) ?></b></div>
		    <?php } ?>
				</div>
			    </div>	      <?php } ?>
    		</div>
    		<div class="brdrline"></div>
    	    </div>
<?php } ?>
	</div>
	<div class="clr"></div>

    </div>
</div>

