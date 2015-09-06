		    <div class="profile_user_info_lang">


			<?php
			foreach ($user->language as $key => $lang) {

			    if ($lang->value == 1) {
				$width = "20px";
			    } elseif ($lang->value == 2) {
				$width = "42px";
			    } elseif ($lang->value == 3) {
				$width = "64px";
			    } elseif ($lang->value == 4) {
				$width = "84px";
			    } elseif ($lang->value == 5) {
				$width = "103px";
			    } else {
				$width = "0px";
			    }
			    ?>
    			<div class="lang_level_box">
    			    <span class="flt_l show_name_level"><?php echo $lang->lang->name; ?>:</span>
    			    <ul class="lang_level flt_r show_lang_level">
    				<li class="level" style="width:<?php echo $width; ?>"></li>
    				<li><div class="out1 pop" title="<?php echo Yii::t('default','wgt.langstar.level_1')?>"></div></li>
    				<li><div class="out2 pop" title="<?php echo Yii::t('default','wgt.langstar.level_2')?>"></div></li>
    				<li><div class="out3 pop" title="<?php echo Yii::t('default','wgt.langstar.level_3')?>"></div></li>
    				<li><div class="out4 pop" title="<?php echo Yii::t('default','wgt.langstar.level_4')?>"></div></li>
    				<li><div class="out5 pop" title="<?php echo Yii::t('default','wgt.langstar.level_5')?>"></div></li>
    			    </ul>
    			</div>
    			<div class="clr"></div>

<?php } ?>
		    </div>
<script>initLang()</script>