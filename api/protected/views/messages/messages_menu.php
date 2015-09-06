
<div class="sub_content_tabs message_page">

    <ul class="sub_tabs">
	<li id="in" class="dialog_user<?php if($type=='in') echo ' active'; ?>">
	    <?php echo MRChtml::ajaxLink(Yii::t('default','imcoming_messages'), '/user/'.$user->id.'/messages/in',
		array(
		    'update' => '#subcontent',
		    'updateUrl' => true,
		    'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:50px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>', 
		    'type' => 'post'),
		    array('id'=>  uniqid('messages'))
	    ) ?>
		</li>
	<li id="out" class="dialog_user<?php if($type=='out') echo ' active' ?>">
	    <?php echo MRChtml::ajaxLink(Yii::t('default','outgoing_messages'), '/user/'.$user->id.'/messages/out', array(
		    'update' => '#subcontent',
		    'updateUrl' => true,
		    'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:50px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>', 
		    'type' => 'post'),
		    array('id'=>  uniqid('messages'))
	    ) ?>
	</li>
      </ul><div class="clr"></div></div>