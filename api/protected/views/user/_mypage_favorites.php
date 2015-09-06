 <div id="subcontent">                <div id="loading">
                    <div id="favorites">
    <?php if(count($user->favorites)){ ?>
        <?php $count = count($user->favorites); ?>
  <?php foreach ($user->favorites as $rent){ 
     $class_last = '';
     if(!--$count) $class_last = " last"; 
     $description =(isset($rent->descriptions[0]))?$rent->descriptions[0] : RentDescription::model()->findByPk(array('rent'=>$rent->id,'language'=>1));
     if(!$description) $description = new RentDescription ();
      if($rent->cover){
	  $avatar2 = '/uploads/rentpic/'.$rent->id.'/thumbs/'.$rent->cover->file;
      }
      elseif(count($rent->photos)&&($rent->photos[0]->file)){
         $avatar2 = '/uploads/rentpic/'.$rent->id.'/thumbs/'.$rent->photos[0]->file;
    }else{
        $avatar2= $this->assetsUrl.'/images/no_gallery_s.png';
        
    }

    ?>
              <div class="board_box">
                  <div class="box_img">		     <?php if((time() - strtotime($rent->creation_date) )< Yii::app()->params['isnew'] ) {  ?>
		    <div class="new p_absolute"><?php echo Yii::t('default','New')?></div>
		    <?php }?>
                      
                      <div style="background-image: url('<?php echo $avatar2;?>')" class="avatar_box"></div>
                      
                  </div>


                    <div style="margin-left: 150px;" class="p_absolute">
                    <div class="trans"><?php echo CHtml::link($description->name,'/rent/'.$rent->id,array('class'=>'link'));?><div class="trans_txt"></div><div class="clr"></div></div>
		    <!--<div class="trans"><small><span><?php echo Yii::t('default','bill address');?>:</span> <?php if(isset($rent->adress)) echo str_replace(Yii::app()->params['AdressPrefix'], '', $rent->adress->name ) ?></small><div class="trans_txt"></div><div class="clr"></div></div>-->
                                         <div class="address_box">
                    <span><?php echo Yii::t('default','bill address');?>:</span>
                    <div><?php if(isset($rent->adress)) echo str_replace(Yii::app()->params['AdressPrefix'], '', $rent->adress->name ) ?></div>
                    </div>
                    <div class="clr"></div>
                  
              <div class="price" style="width:500px;float:left;">
		  <?php $prices_to_view = Yii::app()->params['current_price'];?> <?php echo number_format($rent->$prices_to_view[$rent->current_price]['row'] * $rent->currency->rate / $this->currentCurrency->rate,0,',',' ')  ?> <?php echo Yii::t('default', $this->currentCurrency->short_name)?>
		  <div><?php echo $prices_to_view[$rent->current_price]['name'];?></div>
                  
              </div>
                  
                  
                  <div class="rent_control">
	<?php echo MRChtml::ajaxLink(Yii::t('default', 'to.drop'), '/user/' . $user->id . '/favorites', array('update' => '#subcontent','updateUrl' => true, 'preloadImage'=> '<div class="loading_box_profile" style="left:150px;top:50px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>', 'type' => 'post', 'data' => array('ajax' => true,'fid'=>$rent->id,'unlink'=>true)), array('href'=>'/user/' . $user->id . '/favorites', 'id'=> uniqid('favdrop'), 'class'=>'delete_lang_rent')); ?>   
	  </div>

            </div></div>
              <?php }?>

<?php }else{ ?><div class="pdd_30">
                      <div class="no_component"><p><?php echo Yii::t('default','you.have.not.favorites.rents')?></p><br /><br />
                      
                      </div>
</div>

              <?php }?>
</div>
    </div></div>