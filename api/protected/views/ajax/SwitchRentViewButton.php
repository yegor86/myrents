<?php

    $text = ($_POST['type']=='rent') ? '' : Yii::t('default','show/hide') ;
?>
<?php echo MRChtml::ajaxLink($text, '/switchRentView', array(
			'update' => '#viewbuttn' . $rent->id,
    'preloadImage'=> '<img src="'.$this->getAssetsUrl().'/images/s-loading.gif" border="0" alt="">','append_or_html'=>'html', 
			'type'=>'post',
			'data'=>array('rentId'=>$rent->id, 'type'=>$_POST['type'])
		    ), array('class'=>'view viewstatus' . $rent->in_show,'id'=> uniqid('aview'))) ?>
