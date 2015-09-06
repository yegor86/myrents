        <div style="padding:0 0 5px 10px;">
        Показать: 
	<?php
	$linkset = array(
	    '/members' => 'membermenu.all',
	    '/members/agency' => 'membermenu.agency',
	    '/members/realtors' => 'membermenu.realtors',
	    '/members/private' => 'membermenu.private',
	);

	foreach ($linkset as $url => $linkName) {
	    echo MRChtml::ajaxLink(Yii::t('default', $linkName), $url, array(
		'url' => $url,
		'update' => '#content',
		'updateUrl' => true,
		'preloadImage' => '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:50px"><div class="wborder"><h3>' . Yii::t('default', 'loading') . '...</h3><div class="loading_search"></div></div></div>',
		'type' => 'get'
		    ), array(
			'class' => "btn6" . ($selflink==$url?' active':''),
			"href" => $url));
	}
	?>

</div>
