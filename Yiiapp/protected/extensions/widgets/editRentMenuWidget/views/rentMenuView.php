            <script type="text/javascript">
                $('.uptop').fancybox({
                    'autoDimensions'	: false,
                    'padding'		: 0,
                    'autoScale':false,
                    'centerOnScroll':true,
                    'margin':5,
                    'showCloseButton':false,
                    'enableEscapeButton':false,
                    'scrolling'		: 'no'
                });
            </script><ul class="controller_menu">
    <?php foreach ($menuItems as $menuItem) {
    $content = $menuItem->link;
    if($menuItem->isNeeded) $content = $content . '<div class="needDiv"></div>';
     echo CHtml::tag('li',array('class'=>($this->active == $menuItem->option)?'active':''), $content);
    /*     
     если требуется установить флаг, то ссылка создаётся с классом isneeded
     так-же появляется блок с классом needDiv
    
    т.е. можно подкрасить самы ссылку, ну а картинку впихнуть в блок  needDiv
    
    проверить надо ли указывать необходимость - if($menuItem->isNeeded)
    */

    }?>
    
    
    
    
    <li <?php if ($this->active == 'drop') echo 'class="active"'; else echo 'class="dropurl"'; ?>><?php echo CHtml::link(Yii::t('default', 'edit bill menu drop'), '/rent/' . $this->rentid . '/drop') ?></li>
</ul>


 
<ul class="edit_rent_option">
    <li><a href="/rent/<?php echo $this->rentid?>" target="_blank"><?php echo Yii::t('default','rent.view');?></a></li>
    <li><span id="viewbuttn<?php echo $this->rentid?>" style="height:30px;">  
		    <?php echo MRChtml::ajaxLink(Yii::t('default','show/hide'), '/switchRentView', array(
			'update' => '#viewbuttn' . $this->rentid,
                        'preloadImage'=> '<img src="'.$this->getAssetsUrl().'/images/s-loading.gif" border="0" alt="">','append_or_html'=>'html', 
			'type'=>'post',
			'data'=>array('rentId'=>$this->rentid, 'type'=>'editrent')
		    ), array('class'=>'view viewstatus' . $this->in_show,'id'=>uniqid('aview'))) ?>
		  </span></li>
    <li><?php echo CHtml::link(Yii::t('default','up.rent up'),'/up/'.$this->rentid,array('value'=>$this->rentid,'class'=>' upbtn uptop fancybox.ajax'))?></li>
</ul>


            <small style="margin: 5px 15px 0 30px;font-size: 11px;color:#B2B2B2;line-height: 15px;display: none"><?php echo Yii::t('default','edit bill menu text') ?></small>