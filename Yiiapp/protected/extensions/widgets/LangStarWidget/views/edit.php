                    <b class="stl_2"><?php echo Yii::t('default','wgt.langstar.language_know'); ?>:</b><br /><br />
                    <div id="AddLangBox">       

                 
                    <b class="stl_5"><?php echo Yii::t('default','wgt.langstar.add_language'); ?>:</b><select name="lang" class="mrg_lft_10" id="SelectLang">
                        <option value="sel" main="main">---</option>
                    </select></div>
                                          <div class="countLnag">
                <?php foreach ($langs as  $key => $lang)  { ?>
                        <?php $checked=false;  
                        if(in_array($lang->id,$langsArray['id'])){$checked='checked';} 
                        ?>
                        <?php echo $form->checkBox($lang,'['.$key.']id', array('checked'=>$checked, 'style'=>'display:none;')); ?>
                    <?php 
                       if($checked){
                           echo $form->textField($user->language[$langsArray['keys'][$lang->id]],"[$key]value", array('style'=>'display:none;'));
                           ?>
                  
                    <?php
                     }else {
                           $newlang = new UserLang();
                           $newlang->value=0;
                           echo $form->textField($newlang,"[$key]value", array('style'=>'display:none;'));
                           
            
                       }
                    ?>
    <table border="0" width="30%" id="table<?php echo $key;?>" style="margin-left: 26px">
                            <tr>
                                <td colspan="2" width="100%"><span class="stl_2 lang_name<?php echo $key;?>" style="color:#368bc6;padding-top: 7px;"></span></td>
                            </tr>
                            <tr>
                                <td width="300">
                
               
                    <div class="flt_r show_<?php echo $key;?>" style="margin: 0 0 0 0;">
        <ul class="lang_level lang_<?php echo $key;?>" >
        <li class="level"></li>
        <li><div class="out1 pop" OnMouseOver="this.className='over1';" OnMouseOut="this.className='out1';" OnClick="LoadGet('1','20', '<?php echo $key;?>');" title="<?php echo Yii::t('default','wgt.langstar.level_1'); ?>"></div></li>
	<li><div class="out2 pop" OnMouseOver="this.className='over2';" OnMouseOut="this.className='out2';" OnClick="LoadGet('2','42', '<?php echo $key;?>');" title="<?php echo Yii::t('default','wgt.langstar.level_2'); ?>"></div></li>
	<li><div class="out3 pop" OnMouseOver="this.className='over3';" OnMouseOut="this.className='out3';" OnClick="LoadGet('3','64', '<?php echo $key;?>');" title="<?php echo Yii::t('default','wgt.langstar.level_3'); ?>"></div></li>
        <li><div class="out4 pop" OnMouseOver="this.className='over4';" OnMouseOut="this.className='out4';" OnClick="LoadGet('4','84', '<?php echo $key;?>');" title="<?php echo Yii::t('default','wgt.langstar.level_4'); ?>"></div></li>
	<li><div class="out5 pop" OnMouseOver="this.className='over5';" OnMouseOut="this.className='out5';" OnClick="LoadGet('5','103', '<?php echo $key;?>');" title="<?php echo Yii::t('default','wgt.langstar.level_5'); ?>"></div></li>
        </ul>
                    </div>
                    
                            </td><td width="70"><div class="lang_btn<?php echo $key;?>" style="margin-left:10px;text-align:right;"></div></td></tr>

                       </table>
<div class="clr"></div>     
                    <?php } ?>
                                          </div>
		    <script>initLang()</script>
