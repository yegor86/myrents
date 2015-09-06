<?php
$this->pageTitle=$user['firstname'].'  '.$user['lastname'];
?>

 <div class="main one">
    <div class="mainhead">
      <div>
        <div>
          <div></div>
          <table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle">Your profile</td><td><a href="/search/" class="search_btn flt_r"></a></td></tr></table>
        </div>
      </div>
    </div>
    <div class="content">

<?php $this->widget('ext.widgets.UserTabsWidget.UserTabsWidget', array('user'=>$user,'view'=>'mypageMenu', 'activetab'=>'friends'))?>
	 <?php echo CHtml::link(Yii::t('default', 'Редактировать профиль'), '/user/edit', array('class' => 'edit_profile_btn')) ?>
        
	    <div class="profile_box tab_content">
		<div class="flt_l profile_user_avatar"> 
		    <?php if (file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] .  "userpic/" . $user['image'])) { ?>
			<?php echo CHtml::image("/uploads/userpic/" . $user['image'], $user['firstname'] . ' ' . $user['lastname'], array('class' => 'avatar', 'width' => '260')) ?>
		    <?php
		    } else {
			echo "<img src='/uploads/userpic/noimage.jpg' class='avatar' width='260'>";
		    }
		    ?>
		    <center>
			<ul class="urating" title="Рейтинг: 4.8 Средняя оценка: 4">
			    <li class="crating" style="width: 168px;"></li>
			    <li><div class="out1" OnMouseOver="this.className='over1';" OnMouseOut="this.className='out1';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="RATE1"></div></li>
			    <li><div class="out2" OnMouseOver="this.className='over2';" OnMouseOut="this.className='out2';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="RATE2"></div></li>
			    <li><div class="out3" OnMouseOver="this.className='over3';" OnMouseOut="this.className='out3';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="RATE3"></div></li>
			    <li><div class="out4" OnMouseOver="this.className='over4';" OnMouseOut="this.className='out4';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="RATE4"></div></li>
			    <li><div class="out5" OnMouseOver="this.className='over5';" OnMouseOut="this.className='out5';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="RATE5"></div></li>
			</ul>
			<div class="result_rating"><?php echo Yii::t('default','рейтинг')?> <b>4.8</b></div></center>



		</div>
		<div class="flt_l profile_user_info">
		    <h2 class="stl_2"><?php echo($user['firstname']) ?> <?php echo($user['lastname']) ?></h2>
		    <div class="u_info"><b><?php echo Yii::t('default','Дата регистрации')?>:</b><span><?php echo $user['member_since'] ?></span></div>
		    <div class="u_info"><b><?php echo Yii::t('default','Последняя активность') ?>:</b><span><?php echo $user['last_worked'] ?></span></div>
		    <div class="clr"></div>
		<?php   $this->widget('ext.widgets.LangStarWidget.LangStarWidget', array('user'=>$user));?>

		</div>
		<div class="flt_r profile_user_contact">
		    <?php if ($user['phone']) { ?><div><b><?php echo Yii::t('default','Телефоны') ?>:</b><span><?php echo CustomFunctions::slashNtoBR($user['phone']) ?></span></div><?php } ?>
		    <?php if ($user['skype']) { ?><div><b><?php echo Yii::t('default','Скайп') ?>:</b><span><?php echo $user['skype'] ?></span></div><?php } ?>
<?php if ($user['email']) { ?> <div><b><?php echo Yii::t('default','Электронная почта') ?>:</b><span><?php echo $user['email'] ?></span></div><?php } ?>
		    <div><span><a href="#"><?php echo Yii::t('default','Посмотреть всё') ?></a></span></div>
		</div>
		<div class="clr"></div>
	    </div>

        <div class="pdd_10"></div>

<div id="subcontent"><div id="loading">
    <div class="tab_content pdd_10">
FRIENDS</div>
</div>
  </div> </div> </div>
