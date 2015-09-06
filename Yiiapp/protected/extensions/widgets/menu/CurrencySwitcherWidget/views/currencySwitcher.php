<?php $cur_class_sel = strtolower($currentCurrency->short_name);
$ratem = ($currentCurrency->rate!=1) ? round($currentCurrency->rate,2) : '';
?>
<li id="currency">
    <div class="menu_h_border " style="padding-right:10px"><span><?php echo Yii::t('default', 'currency') ?>:</span> <a href="javascript:void(0)" class="<?php echo $cur_class_sel;?> curmain" style="padding-left: 15px"> <span style="padding:0;"><?php echo $currentCurrency->full_name ?></span><span style="padding-right:0px;text-align:right"><?php echo $ratem ?></span></a>

        <div id="currency_pop"><div class="free_layer"></div>
            <div class="popup_box">

                <div id="close_currency_pop" style="padding-right:0;position:relative"><span><?php echo Yii::t('default', 'currency') ?>:</span> 
                    <a href="javascript:void(0)" class="<?php echo $cur_class_sel;?> curmain"  style="padding-left: 15px"> <span style="padding:0;"><?php echo $currentCurrency->full_name ?></span><span style="position:absolute;right:0;top:0; padding:1px 11px 0 0;"><?php echo $ratem ?></span></a></div>

                <table width="100%" cellpadding="0" cellspacing="0">
                <?php
                foreach ($currencies as $currency) {
                    ?>
                    <tr>
                    <?php
                    $checked = '';
                    if($currency->rate!=1) $rate = round($currency->rate,2);
                    if ($currency == $currentCurrency)
                        $checked = ' current';
 
                        ?>
                <?php $cur_class = strtolower($currency->short_name);?>
                <?php if ($currency->id==1){?>
                    
<td width="70%" height="30px"><?php echo CHtml::ajaxLink('<span style="padding:0;">'.$currency->full_name.'</span>', '/setcurrency', array('type' => 'post', 'data' => 'currency=' . $currency->id, 'update' => '#refreshdiv'), array('class' => 'mlink '.$cur_class.'' . $checked, 'style'=>'padding-left:30px;padding-right:0px;')) ?></td>
                        
                        <td width="30%" height="30px"></td>
                
                            <?php }else{?>
                             <td width="70%" height="30px"><?php echo CHtml::ajaxLink('<span style="padding:0;">'.$currency->full_name.'</span>', '/setcurrency', array('type' => 'post', 'data' => 'currency=' . $currency->id, 'update' => '#refreshdiv'), array('class' => 'mlink '.$cur_class.'' . $checked, 'style'=>'padding-left:30px;padding-right:0px;')) ?></td>  
                             <td width="30%" align="right" height="30px"><span style="padding-right:10px;"><?php echo CHtml::ajaxLink($rate, '/setcurrency', array('type' => 'post', 'data' => 'currency=' . $currency->id, 'update' => '#refreshdiv'),array('style'=>'color:#838383')) ?></span></td>
                        
                                        
              
                <?php } ?>
</tr>
 <?php } ?></table>
            </div> 
        </div></div> 
</li>