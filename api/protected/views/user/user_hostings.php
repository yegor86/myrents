<?php
$this->pageTitle=$user['firstname'].'  '.$user['lastname'];
?>
<div class="main one">
    <div class="mainhead">
      <div>
        <div>
          <div></div>
          <table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td><a href="/search/" class="search_btn flt_r popEdge" title="<?php echo Yii::t('default','search.button');?>"></a></td></tr></table>
        </div>
      </div>
    </div>
    

<div class="content">
        <div class="profile_box tab_content">
            <div class="flt_l profile_user_avatar">

<?php if (file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] .  "userpic/" . $user['image'])) { 
                
                          echo '<span class="avatar"><span class="big_avatar" style="background-image:url(\'/uploads/userpic/'.$user['image'].'\')"></span></span>';

		    } else {
			
                        echo '<span class="avatar"><span class="big_avatar" style="background-image:url(\'/uploads/userpic/noimage.jpg\')"></span></span>';
		    }
		    ?>             
            <center style="display:none">
            <ul class="urating" title="Рейтинг: 4.8 Средняя оценка: 4">
            <li class="crating" style="width: 168px;"></li>
        <li><div class="out1" OnMouseOver="this.className='over1';" OnMouseOut="this.className='out1';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="<?php echo Yii::t('default','user.rating_level_1');?>"></div></li>
	<li><div class="out2" OnMouseOver="this.className='over2';" OnMouseOut="this.className='out2';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="<?php echo Yii::t('default','user.rating_level_2');?>"></div></li>
	<li><div class="out3" OnMouseOver="this.className='over3';" OnMouseOut="this.className='out3';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="<?php echo Yii::t('default','user.rating_level_3');?>"></div></li>
        <li><div class="out4" OnMouseOver="this.className='over4';" OnMouseOut="this.className='out4';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="<?php echo Yii::t('default','user.rating_level_4');?>"></div></li>
	<li><div class="out5" OnMouseOver="this.className='over5';" OnMouseOut="this.className='out5';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="<?php echo Yii::t('default','user.rating_level_5');?>"></div></li>
            </ul>
<div class="result_rating">rating <b>4.8</b></div></center>
                
               
            </div>            
            <div class="flt_l profile_user_info">
                <h2 class="stl_2"><?php echo($user['firstname'])?> <?php echo($user['lastname'])?></h2>
                <div class="u_info"><b><?php echo Yii::t('default','user.member since')?>:</b><span><?php echo substr($user['member_since'], 0, strlen($user['member_since']) -3);?></span></div>
                <div class="u_info"><b><?php echo Yii::t('default','user.last woraked')?>:</b><span><?php echo substr($user['last_worked'], 0, strlen($user['last_worked']) -3);?></span></div>
                <div class="clr"></div>
<?php   $this->widget('ext.widgets.LangStarWidget.LangStarWidget', array('user'=>$user,));?>
            </div>
            <div class="profile_user_contact">
            <?php if($user['phone']){?><div><b><?php echo Yii::t('default','Phone') ?>:</b><span><?php echo CustomFunctions::slashNtoBR($user['phone']) ?></span></div><?php } ?>
            <?php if($user['skype']){?><div><b><?php echo Yii::t('default','Skype') ?>:</b><span><?php echo $user['skype'] ?></span></div><?php } ?>
           <?php if($user['email']){?> <div><b><?php echo Yii::t('default','Email') ?>:</b><span><?php echo $user['email'] ?></span></div><?php }?>


        </div>
        <div class="clr"></div>
      </div>
      <div class="pdd_10"></div>

<?php $this->widget('ext.widgets.UserTabsWidget.UserTabsWidget', array('user'=>$user,'view'=>'userpageMenu', 'activetab'=>'hostings'))?>
	  
	  
	  <div id="subcontent">
	      <?php require('_user_hostings.php'); ?>
	  </div>
 
    </div>
