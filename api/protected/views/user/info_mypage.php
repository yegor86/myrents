
            <div id="subcontent">
                <div id="loading">


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
			    <li><div class="out1" OnMouseOver="this.className='over1';" OnMouseOut="this.className='out1';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="RATE1"></div></li>
			    <li><div class="out2" OnMouseOver="this.className='over2';" OnMouseOut="this.className='out2';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="RATE2"></div></li>
			    <li><div class="out3" OnMouseOver="this.className='over3';" OnMouseOut="this.className='out3';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="RATE3"></div></li>
			    <li><div class="out4" OnMouseOver="this.className='over4';" OnMouseOut="this.className='out4';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="RATE4"></div></li>
			    <li><div class="out5" OnMouseOver="this.className='over5';" OnMouseOut="this.className='out5';" OnClick="LoadGet(); return false;" OnDblClick="LoadGet(); return false;" title="RATE5"></div></li>
			</ul>
			<div class="result_rating" style="display:none"><?php echo Yii::t('default','рейтинг')?> <b>4.8</b></div></center>



		</div>

		<div class="flt_l profile_user_info">
		    <h2 class="stl_2"><?php echo($user['firstname']) ?> <?php echo($user['lastname']) ?></h2>
		    <div class="u_info"><b><?php echo Yii::t('default','Дата регистрации')?>:</b><span><?php echo substr($user['member_since'], 0, strlen($user['member_since']) -3);?></span></div>
		    <div class="u_info"><b><?php echo Yii::t('default','Последняя активность') ?>:</b><span><?php echo substr($user['last_worked'], 0, strlen($user['last_worked']) -3);?></span></div>
		    <div class="clr"></div>
		<?php   $this->widget('ext.widgets.LangStarWidget.LangStarWidget', array('user'=>$user));?>

		</div>
		<div class="flt_r profile_user_contact"><div style="padding-top: 0px">
		    <?php if ($user['phone']) { ?><div><b><?php echo Yii::t('default','Телефоны') ?>:</b><span><?php echo CustomFunctions::slashNtoBR($user['phone']) ?></span></div><?php } ?>
		    <?php if ($user['skype']) { ?><div><b><?php echo Yii::t('default','Скайп') ?>:</b><span><?php echo $user['skype'] ?></span></div><?php } ?>
                    <?php if ($user['email']) { ?><div><b><?php echo Yii::t('default','Email') ?>:</b><span><?php echo $user['email'] ?></span></div><?php } ?>

		</div></div>
		<div class="clr"></div>



            
            
            <div class="tab_content pdd_10" style="border-left:0; border-bottom: 0; border-right: 0;">

<?php if($user->overview) { ?>
<div style="padding:0 10px 0 10px;text-indent: 25px;"><pre><?php echo $user['overview'] ?></pre></div>
<?php }?>
</div></div></div>



            
            
           



