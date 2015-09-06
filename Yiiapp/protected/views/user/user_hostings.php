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
    <script>
    $(function(){
       $('.reedmore').click(function(){
           $(this).toggleClass('active');
           $('#user_description').slideToggle(0);
       });
    });  
</script>

<div class="content">
        <div class="profile_box tab_content" style="padding: 0 0 15px 0">
            <div class="flt_l profile_user_avatar">

<?php if (is_file(Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] .  "userpic/" . $user['image'])) { 
                
                          echo '<span class="avatar"><span class="big_avatar" style="background-image:url(\'/uploads/userpic/'.$user['image'].'\')"></span></span>';

		    } else {
			
                        echo '<span class="avatar"><span class="big_avatar" style="background-image:url(\'/uploads/userpic/noimage.jpg\')"></span></span>';
		    }
		    ?>     
                
                		
                <a style="margin-top: 20px" class="btn_border abutton yellow" href="/messages/send/<?php echo $user['id']?>" ><span><b><i><?php echo Yii::t('default', 'Send message') ?></i></b></span></a>
	
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
                     <div class="u_info"><?php echo Yii::t('default','rentertype.'.$user->rentertype); ?>:<b class="stl_6"><?php echo($user['firstname']) ?> <?php echo($user['lastname']) ?></b></div>

		    <div class="clr"></div>
<?php   $this->widget('ext.widgets.LangStarWidget.LangStarWidget', array('user'=>$user,));?>
                    <?php if($user->overview) { ?><span class="reedmore"><?php echo Yii::t('default','reed.more')?></span><?php }?>

            </div>
            <div class="profile_user_contact">
                    <?php if ($user['phone']) { ?><div class="u_info"><?php echo Yii::t('default','Phone') ?>:<b class="stl_7"><?php echo CustomFunctions::slashNtoBR($user['phone']) ?></b></div><?php } ?>
                    <?php if ($user['skype']) { ?><div class="u_info"><?php echo Yii::t('default','Skype') ?>:<b class="stl_7"><?php echo $user['skype'] ?></b></div><?php } ?>
                    <?php if ($user['email']) { ?><div class="u_info"><?php echo Yii::t('default','Email') ?>:<b class="stl_7"><?php echo $user['email'] ?></b></div><?php } ?>
		    <div class="u_info"><?php echo Yii::t('default','user.member since')?>:<b class="stl_7"><?php echo Yii::t('monthOfYear', date("F",  strtotime($user['member_since']))) ?><?php echo date(" d, Y",  strtotime($user['member_since'])) ?></b></div>
		    <div class="u_info"><?php echo Yii::t('default','user.last woraked') ?>:<b class="stl_7"><?php echo Yii::t('monthOfYear', date("F",  strtotime($user['last_worked']))) ?><?php echo date(" d, Y",  strtotime($user['last_worked'])) ?></b></div>

        </div>
        <div class="clr"></div>
        <div id="user_description"><?php echo $user['overview'];?></div>
      </div>
      <div class="pdd_10"></div>

<?php $this->widget('ext.widgets.UserTabsWidget.UserTabsWidget', array('user'=>$user,'view'=>'userpageMenu', 'activetab'=>'hostings'))?>
	  
	  
	  <div id="subcontent">
	      <?php require('_user_hostings.php'); ?>
	  </div>
    </div>
