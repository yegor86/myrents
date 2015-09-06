

        <div style="position: fixed;z-index:6;"><div class="loading_box" style="margin-top: 20px"><div class="wborder"><h3><?php echo Yii::t('default','loading search')?>...</h3><div class="loading_search"></div></div></div></div>

<script type="text/javascript">
    $('#foundcount').html('<?php echo $count ?>');
    api.clearAllMarks();
    var min_x=999;
    var max_x=0;
    var min_y=999;
    var max_y=0;
    <?php //if(isset ($rents[0])) echo 'setCenter(' . $rents[0]->adress->geox . ',' .  $rents[0]->adress->geoy . ')' ?>
 </script>
<div id="loading">

		<?php 
                if(count($top)){
		echo '<div id="top_rents">';
		foreach ($top  as $topRent) {
        				if ($topRent->todo == 3) {
				    $avatar = $this->getAssetsUrl() . '/images/buy_image.png';
				} elseif ($topRent->cover){
				    $avatar = '/uploads/rentpic/' . $topRent->id . '/thumbs/' . $topRent->cover->file;
                                } elseif (($topRent->photos) && ($topRent->photos[0]->file)) {
				    $avatar = '/uploads/rentpic/' . $topRent->id . '/thumbs/' . $topRent->photos[0]->file . '';
				} else {
                                    $avatar = $this->getAssetsUrl() . '/images/no_gallery_s.png';
				}
    
    				$description = (isset($topRent->descriptions[0]))?$topRent->descriptions[0]:
				RentDescription::model()->findByPk(array(
				    'rent'=>$topRent->id,
				    'language'=>'1'
				));
                                ?>
                <div class="search_box">


	                    <a href="/rent/<?php echo $topRent->id;?>"><span class="search_img_box" style="background-image: url('<?php echo $avatar ?>')"></span></a>
 		   		   <?php if(!Yii::app()->user->isGuest&&$topRent->user==Yii::app()->user->id){?> <?php echo CHtml::link('','/up/' . $topRent->id.'/', array('value'=>$topRent->id,'class'=>'upbtn_search p_absolute uptop fancybox.ajax'))?> <?php }?>
                    		     <?php if((time() - strtotime($topRent->creation_date) )< Yii::app()->params['isnew'] ) {  ?>
		    <div class="status_board new"><?php echo Yii::t('default','New')?></div>
		    <?php }?>
                    <a class="addfav pop" style="display:none" href="javascript:void(0)" title="<?php echo Yii::t('default','add to favorites');?>"></a>
                    <!--<div class="user"><a href="/user/<?php echo $topRent->renter->id ?>"><img src="<?php echo Yii::app()->params['USERPHOTOSDIR'] . $topRent->renter->image ?>" width="40" border="0" height="40" alt="" /></a></div>-->
                    <div class="user"><a href="/user/<?php echo $topRent->renter->id ?>"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR'] .'little/'. $topRent->renter->image ?>')"></span></a>
					    <ul class="controls">
						<li><a target="_blank" href="/user/<?php echo $topRent->renter->id ?>"><?php echo Yii::t('default', 'usermenu.bills'); ?></a></li>
	<?php if (!Yii::app()->user->isGuest) { ?><li><a target="_blank" href="/user/<?php echo $topRent->renter->id ?>/messages/send/<?php echo $topRent->renter->id ?>"><?php echo Yii::t('default', 'usermenu.message'); ?></a></li><?php } ?>
                                                 <li><a target="_blank" href="/user/<?php echo $topRent->renter->id ?>/"><?php echo Yii::t('default', 'usermenu.profile'); ?></a></li>
					    </ul>
                    </div>
                    <div class="trans"><?php echo CHtml::link($description->name, '/rent/' . $topRent->id, array('class' => 'link')); ?><div class="trans_txt"></div><div class="clr"></div></div>
		    <!--<div class="trans"><small><span><?php echo Yii::t('default','bill address');?>:</span><?php if (isset($topRent->adress)) {
		    if(Yii::app()->language=='en'&&$topRent->adress->name_en) echo $topRent->adress->name_en;
		    else    echo $topRent->adress->name ;}?></small><div class="trans_txt"></div><div class="clr"></div></div>-->
                    <div class="address_box">
                    <span><?php echo Yii::t('default','bill address');?>:</span>
                    <div style="max-width:390px;min-width:390px;"><?php if (isset($topRent->adress)) {
		    if(Yii::app()->language=='en'&&($topRent->adress->name_en)) echo $rent->adress->name_en;
		    else    echo $topRent->adress->name ;}?></div>
                    </div>
                    
                   
                    <table border="0" cellpadding="0" cellspacing="0" width="382px">
                        <tr>
                            <td height="30">
          <?php   foreach ($topRent->amenities as $amenity)    {?>
           
        			<span class="pop icon_n" style="background-image:url('<?php echo ($this->getAssetsUrl()); ?>/images/amenities/<?php echo ($amenity->image); ?>')" title="<?php echo Yii::t('default',$amenity->name); ?>"></span>
  
          <?php }?>
                             </td>
                        </tr>
                    </table>
		    <?php if ($topRent->todo==1) { $tpriced = ($priced)?$priced:$topRent->current_price;?>
		    
                    <div class="price" style="width:153px"><b><?php echo number_format($topRent->$prices_to_view[$tpriced]['row'] * $topRent->currency->rate  / $this->currentCurrency->rate,0,',',' ') ?> <?php echo Yii::t('default', $this->currentCurrency->short_name)?></b>
                        <p align="right"><?php echo Yii::t('default',  $prices_to_view[$tpriced]['row']);?></p>
                    </div>
		    <?php }else {?>
		    <div class="price" style="width:153px"><b><?php echo number_format($topRent->price_day * $topRent->currency->rate  / $this->currentCurrency->rate,0,',',' ') ?> <?php echo Yii::t('default', $this->currentCurrency->short_name)?></b>
                    </div>	    
		    <?php }?>

                </div> <?php 

		};
		 echo '</div>';
                 };
		?>

<?php
if ($rents) {
    foreach ($rents as $rent) {

    				if ($rent->todo == 3) {
				    $avatar = $this->getAssetsUrl() . '/images/buy_image.png';
                                    $mapavatar = $this->getAssetsUrl() . '/images/buy_image_s.png';
				} elseif ($rent->cover){
				    $avatar = '/uploads/rentpic/' . $rent->id . '/thumbs/' . $rent->cover->file;
                                    $mapavatar = $avatar;
                                } elseif (($rent->photos) && ($rent->photos[0]->file)) {
				    $avatar = '/uploads/rentpic/' . $rent->id . '/thumbs/' . $rent->photos[0]->file . '';
                                    $mapavatar = $avatar;
				} else {
				    $mapavatar = $this->getAssetsUrl() . '/images/nophoto.png';
                                    $avatar = $this->getAssetsUrl() . '/images/no_gallery_s.png';
				}
				$description = (isset($rent->descriptions[0]))?$rent->descriptions[0]:
				RentDescription::model()->findByPk(array(
				    'rent'=>$rent->id,
				    'language'=>'1'
				));
                                
?>

<?php $shortname = Yii::t('default', $this->currentCurrency->short_name);?>
    <?php $cur_row = Yii::t('default', $prices_to_view[$rent->current_price]['row']); ?>
				    <?php if ($rent->todo == 1) { ?>
                                        <?php $price = number_format($rent->$prices_to_view[$rent->current_price]['row'] * $rent->currency->rate / $this->currentCurrency->rate, 0, ',', ' ');?>
	    	
				<?php } else { ?>
	    			    <?php //$price .= '<div class="price" style="width:153px">';?>
	    			<?php $price = number_format($rent->price_day * $rent->currency->rate / $this->currentCurrency->rate, 0, ',', ' ');?>

	    			    <?php //$price .= '</div>';?>
				<?php } ?>
<script type="text/javascript">
    
        <?php   if($rent->adress) echo 'api.setMark({
	geoX:' . $rent->adress->geox . ',
	geoY:' . $rent->adress->geoy . ',
	title:\'' . $description->name . '\',
	link:"/rent/' . $rent->id . '",
	avatar:"' . $mapavatar . '",
	price:"'.$price.'", 
	shortname:"'.$shortname.'", 
	cur_row:"'.$cur_row.'"});' ?>
    
  if(min_x><?php echo $rent->adress->geox?>)min_x = <?php echo $rent->adress->geox?>;
  if(min_y><?php echo $rent->adress->geoy?>)min_y = <?php echo $rent->adress->geoy?>;
if(max_x<<?php echo $rent->adress->geox?>)max_x = <?php echo $rent->adress->geox?>;
if(max_y<<?php echo $rent->adress->geoy?>)max_y = <?php echo $rent->adress->geoy?>;
</script>

                <div class="search_box">


	                    <a href="/rent/<?php echo $rent->id;?>"><span class="search_img_box" style="background-image: url('<?php echo $avatar ?>')"></span></a>
 		   		   <?php if(!Yii::app()->user->isGuest&&$rent->user==Yii::app()->user->id){?> <?php echo CHtml::link('','/up/' . $rent->id.'/', array('value'=>$rent->id,'class'=>'upbtn_search p_absolute uptop fancybox.ajax row'))?> <?php }?>
                    		     <?php if((time() - strtotime($rent->creation_date) )< Yii::app()->params['isnew'] ) {  ?>
		    <div class="status_board new"><?php echo Yii::t('default','New')?></div>
		    <?php }?>
                    <a class="addfav pop" style="display:none" href="javascript:void(0)" title="<?php echo Yii::t('default','add to favorites');?>"></a>
                    <!--<div class="user"><a href="/user/<?php echo $rent->renter->id ?>"><img src="<?php echo Yii::app()->params['USERPHOTOSDIR'] . $rent->renter->image ?>" width="40" border="0" height="40" alt="" /></a></div>-->
                    <div class="user"><a href="/user/<?php echo $rent->renter->id ?>"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR'] .'little/'. $rent->renter->image ?>')"></span></a>
					    <ul class="controls">
						<li><a target="_blank" href="/user/<?php echo $rent->renter->id ?>"><?php echo Yii::t('default', 'usermenu.bills'); ?></a></li>
	<?php if (!Yii::app()->user->isGuest) { ?><li><a target="_blank" href="/user/<?php echo $rent->renter->id ?>/messages/send/<?php echo $rent->renter->id ?>"><?php echo Yii::t('default', 'usermenu.message'); ?></a></li><?php } ?>
                                                 <li><a target="_blank" href="/user/<?php echo $rent->renter->id ?>/"><?php echo Yii::t('default', 'usermenu.profile'); ?></a></li>
					    </ul>
                    </div>
                    <div class="trans"><?php echo CHtml::link($description->name, '/rent/' . $rent->id, array('class' => 'link')); ?><div class="trans_txt"></div><div class="clr"></div></div>
		    <!--<div class="trans"><small><span><?php echo Yii::t('default','bill address');?>:</span><?php if (isset($rent->adress)) {
		    if(Yii::app()->language=='en'&&$rent->adress->name_en) echo $rent->adress->name_en;
		    else    echo $rent->adress->name ;}?></small><div class="trans_txt"></div><div class="clr"></div></div>-->
                    <div class="address_box">
                    <span><?php echo Yii::t('default','bill address');?>:</span>
                    <div style="max-width:390px;min-width:390px;"><?php if (isset($rent->adress)) {
		    if(Yii::app()->language=='en'&&($rent->adress->name_en)) echo $rent->adress->name_en;
		    else    echo $rent->adress->name ;}?></div>
                    </div>
                    
                   
                    <table border="0" cellpadding="0" cellspacing="0" width="382px">
                        <tr>
                            <td height="30">
          <?php   foreach ($rent->amenities as $amenity)    {?>
           
        			<span class="pop icon_n" style="background-image:url('<?php echo ($this->getAssetsUrl()); ?>/images/amenities/<?php echo ($amenity->image); ?>')" title="<?php echo Yii::t('default',$amenity->name); ?>"></span>
  
          <?php }?>
                             </td>
                        </tr>
                    </table>
		    <?php if ($rent->todo==1) { $tpriced = ($priced)?$priced:$rent->current_price;?>
		    
                    <div class="price" style="width:153px"><b><?php echo number_format($rent->$prices_to_view[$tpriced]['row'] * $rent->currency->rate  / $this->currentCurrency->rate,0,',',' ') ?> <?php echo Yii::t('default', $this->currentCurrency->short_name)?></b>
                        <p align="right"><?php echo Yii::t('default',  $prices_to_view[$tpriced]['row']);?></p>
                    </div>
		    <?php }else {?>
		    <div class="price" style="width:153px"><b><?php echo number_format($rent->price_day * $rent->currency->rate  / $this->currentCurrency->rate,0,',',' ') ?> <?php echo Yii::t('default', $this->currentCurrency->short_name)?></b>
                    </div>	    
		    <?php }?>

                </div> 
    <?php }?>
<script>
    api.setBounds([[min_y,min_x],[max_y,max_x]],"YMapsID");
    </script>
<?php }else{
?>
    <div class="no_found"><center><?php echo Yii::t('default','nothing.founded')?>, <a href="javascript:void(0)" id="reset_filter" onClick="resetFilter('<?php echo Yii::app()->params['prices']['min']; ?>','<?php echo Yii::app()->params['prices']['max']; ?>','<?php echo Yii::app()->params['prices_sale']['min']; ?>','<?php echo Yii::app()->params['prices_sale']['max']; ?>', '<?php echo $squaremin?>', '<?php echo $squaremax?>', '<?php echo Yii::app()->params['floors_to_search'][$this->curlang->language][0]?>', '<?php echo Yii::t('default','any')?>');"><?php echo Yii::t('default','clear')?></a> <?php echo Yii::t('default','search params')?></center></div>
    
<?php } ?>


	<div class="clr"></div>

<?php $this->widget('ext.widgets.SearchPagerWidget.SearchPagerWidget', array(
    'pages' => $pages,
    'maxButtonCount'=>Yii::app()->params['maxbuttonCount'],
    'header'=>'',
    'cssFile'=>$this->getAssetsUrl().'/css/pagination.css',
    'skin'=>'myrents',
	              'firstPageLabel' => Yii::t('default','pagination.first.label'),
                                'lastPageLabel'  =>Yii::t('default','pagination.last.label')
    
))?>



	<!-- вывод за пределами блока -->
<?php if($text){?><div class="clr"></div>
        <div class="search_context">
        <h1><?php echo $text->h1;?></h1>
        <p><?php echo $text->content;?></p>
        </div>
    <?php }?>

 </div>
<script type="text/javascript">
    init_uplink();
    init_tiptip();
</script>
