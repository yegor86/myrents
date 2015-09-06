 <li id="lang"><div class="menu_h_border"><?php echo CHtml::link($curlang->name . ' <img src="'. $this->assetsUrl.'/images/arr_down.png" border="0" width="9" height="7" alt="' . $curlang->language . '" />', 'javascript:void(0)', array('class' => 'mlink lang_' . $curlang->language, 'style' => 'padding-left:20px;')) ?>


                                <div id="lang_pop"><div class="free_layer"></div>

                                    <div class="popup_box" style="padding-bottom: 3px;">
                                        <div id="close_lang_pop"><?php echo CHtml::link($curlang->name . ' <img src="'.$this->assetsUrl.'/images/arr_up.png" border="0" width="9" height="7" alt="' . $curlang->language . '" />', 'javascript:void(0)', array('class' => 'mlink lang_'.$curlang->language, 'style'=>'padding-left:20px')) ?></div>

                                        <?php
                                        foreach ($langs as $lang) {
                                            $checked = '';
                                            if ($lang == $curlang)
                                                $checked = 'current'
                                                ?>

		
					

                                            <div style="padding: 1px 3px 0 11px;">
<?php echo CHtml::ajaxLink($lang->name,
	'/switchLang',
	array('update'=>'#torefresh',
	'data'=>array('lang'=>$lang->language),
	    'type'=>'post'
	    
	),
	array('class' => 'mlink lang_' . $lang->language . ' ' . $checked, 'style' => 'padding-left:20px','href'=>$this->getUrl($lang->language))
	)?>
						
		<?php // echo CHtml::link($lang->name, $this->getUrl($lang->language),array('class' => 'mlink lang_' . $lang->language . ' ' . $checked, 'style' => 'padding-left:20px')) ?>
						
						
		 </div>
<?php } ?>
                                        <div id="refreshdiv"></div></div>

                                </div>
     </div><div id="torefresh"></div>
                        </li>