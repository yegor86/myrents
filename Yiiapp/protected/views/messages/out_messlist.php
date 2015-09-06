<?php if(count($messages)){?>
    <?php foreach ($messages as $message) { ?>

    <div class="message_box">
        <div class="post" href="#" style="display: block">
    	<div class="flt_l">
		<?php
		$avatarImage = (file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] . "userpic/thumbs/" . $message->sender->image)) ? '/uploads/userpic/thumbs/' . $message->receiver->image : '/uploads/userpic/thumbs/noimage.jpg';

		echo CHtml::link('<span style="background-image:url(\'' . $avatarImage . '\')"></span>', '/user/' . $message->receiver->id, array('class' => 'avatar_img_box'));
		?>
<?php $exp = explode(' ', $message->date);?>

    	</div>
    	<div class="ctext" style="padding-top:10px;">
		<?php echo CHtml::link($message->receiver->firstname . ' ' . $message->receiver->lastname, '/user/' . $message->receiver->id, array('class' => 'link')) ?>
	    	<span style="position:absolute;right:50px;margin-top:-2px;font-size:11px;"><?php echo $exp[0] ?> <?php echo $exp[1] ?></span><?php echo MRChtml::ajaxLink('', "/user/".$user->id."/messages/out", array(
		    'update' => '#subcontent',
		    'updateUrl' => true,
		    'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:50px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>', 
		    'type' => 'post',
		    'data'=>array(
			'drop'=>$message->id
		    )
		    ),
		    array('id'=>  uniqid('messagesdrop'),
		'class' => 'flt_r del', 'style' => 'display:block;')) ?>
    	    <pre><?php echo $message->message ?></pre>
    	</div><div class="clr"></div>
        </div>

    </div>
<?php } ?>
<?php }else{?>
    <div class="no_public pdd_30_0"><div class="pdd_30_0"><?php echo Yii::t('messages','messages.empty.outbox');?></div></div>
<?php };?>