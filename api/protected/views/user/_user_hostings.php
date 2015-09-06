<div class="tab_content"><div id="loading">
	      
	   <?php if($rents){ ?>
              <?php foreach ($rents as $rent){ 
                  $language = Language::model()->findByAttributes(array('language'=>Yii::app()->language));
	 $description = (isset($rent->descriptions[0]))?$rent->descriptions[0]:RentDescription::model()->findByPk(
		 array(
		     'rent'=>$rent->id,
		     'language'=>Yii::app()->params['requiredLang']
		 )
		); 
                //  $description = RentDescription::model()->findByAttributes(array('language'=>$language->id,'rent'=>$rent->id));
                  if($description){
                  if(count($rent->photos))
	      if($rent->cover)$img = "/uploads/rentpic/".$rent->id."/thumbs/".$rent->cover->file;
	      elseif($rent->photos[0]->file){
                      $img = "/uploads/rentpic/".$rent->id."/thumbs/".$rent->photos[0]->file;
                  }else{
                      $img = "".$this->assetsUrl."/images/no_gallery_s.png"; 
                    }else $img = "".$this->assetsUrl."/images/no_gallery_s.png"; 
                    


                  ?>
              <div class="board_box">
                  <div class="p_absolute">
              		     <a href="/rent/<?php echo $rent->id?>" style="background-image: url('<?php echo $img;?>')" class="avatar_box"></a>
                <?php if((time() - strtotime($rent->creation_date) )< Yii::app()->params['isnew'] ) {  ?>
		    <div class="status_board new"><?php echo Yii::t('default','New')?></div>
		    <?php }?></div>
              

                  <div style="margin-left: 15px;width:780px;" class="flt_r">
                    <div class="trans"><?php echo CHtml::link($description->name,'/rent/'.$rent->id,array('class'=>'link'));?><div class="trans_txt"></div><div class="clr"></div></div>
		    <!--<div class="trans"><small><span><?php echo Yii::t('default','Адрес');?>:</span> <?php if (isset($rent->adress)) {
		    if(Yii::app()->language=='en'&&($rent->adress->name_en)) echo $rent->adress->name_en;
		    else    echo $rent->adress->name ;}?></small><div class="trans_txt"></div><div class="clr"></div></div>-->
                                       <div class="address_box">
                    <span><?php echo Yii::t('default','bill address');?>:</span>
                    <div><?php if (isset($rent->adress)) {
		    if(Yii::app()->language=='en'&&$rent->adress->name_en) echo $rent->adress->name_en;
		    else    echo $rent->adress->name ;}?></div>
                    </div>
                    <div class="clr"></div>
                    
                                  <?php $prices_to_view = Yii::app()->params['current_price'];
		    if ($rent->todo==1) { $tpriced = $rent->current_price;?>
		    
                    <div class="price" style="width:500px;">
			<?php echo number_format($rent->$prices_to_view[$tpriced]['row'] * $rent->currency->rate  / $this->currentCurrency->rate,0,',',' ')  ?> <?php echo Yii::t('default', $this->currentCurrency->short_name)?>
                        <div><?php echo Yii::t('default',  $prices_to_view[$tpriced]['row']);?></div>
                    </div>
		    <?php }else {?>
		    <div class="price" style="width:500px;"><?php echo number_format($rent->price_day * $rent->currency->rate  / $this->currentCurrency->rate,0,',',' ')  ?> <?php echo Yii::t('default', $this->currentCurrency->short_name)?>
                    </div>	    
		    <?php }?>
		    
		    
		  </div>
            </div>
              <?php } ?>
              
              <?php }}else{?>
              <div class="no_component"><?php echo Yii::t('default','this.user.have.not.created.bills')?></div>
              <?php } ?>
                  <div style="margin:5px 0 0 5px;">
	          	<?php
	$this->widget('ext.widgets.MRPaginator.MRAjaxPaginator', array(
	    'pages' => $pagination,
	    'return'=>'#subcontent',
	    'maxButtonCount' => Yii::app()->params['maxbuttonCount'],
	    'header' => '',
	    'cssFile' => $this->getAssetsUrl() . '/css/pagination.css',
	    'skin' => 'myrents',
	              'firstPageLabel' => Yii::t('default','pagination.first.label'),
                                'lastPageLabel'  =>Yii::t('default','pagination.last.label')
	))
	?>
</div></div><div class="clr"></div></div>
    <script> init_uplink()</script>
