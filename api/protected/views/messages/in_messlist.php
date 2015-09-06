<?php if(count($messages)){?>


    <?php foreach ($messages as $message) { ?>

    <div class="message_box">
        <div class="post">
    	<div class="flt_l">
		<?php
		$avatarImage = (file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] . "userpic/thumbs/" . $message->sender->image)) ? '/uploads/userpic/thumbs/' . $message->sender->image : '/uploads/userpic/thumbs/noimage.jpg';

		echo CHtml::link('<span style="background-image:url(\'' . $avatarImage . '\')"></span>', '/user/' . $message->sender->id, array('class' => 'avatar_img_box'));
		?>
<?php $exp = explode(' ', $message->date);?>
    	    
    	</div>
    	<div class="ctext" style="padding-top:10px;">
		<?php echo CHtml::link($message->sender->firstname . ' ' . $message->sender->lastname, '/user/' . $message->sender->id, array('class' => 'link')) ?>
            <span style="position:absolute;right:50px;margin-top:-2px;font-size:11px;"><?php echo $exp[0] ?> <?php echo $exp[1] ?></span> <?php echo CHtml::link(Yii::t('messages','message.reply'), "/user/".$message->receiver->id."/messages/send/".$message->sender->id."",array('class'=>'btnreply'))?> <?php echo MRChtml::ajaxLink('', "/user/".$user->id."/messages/in", array(
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
    	    
	    
    	    
	    <?php echo'<pre>'. $message->message.'</pre>'?>
	    <?php /* echo MRChtml::ajaxLink('<pre>'. $message->message.'</pre>','/user/'.$message->receiver->id.'/messages/'.$message->id,
		array(
		    'update' => '#subcontent',
		    'updateUrl' => true,
		    'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:50px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>', 
		    'type' => 'post'),
		    array('id'=>  uniqid('messages'))
	    ) */?>
    	</div><div class="clr"></div>
        </div>

    </div>
<?php } ?>
<?php }else{?>
    <div class="no_public pdd_30_0"><div class="pdd_30_0"><?php echo Yii::t('messages','messages.empty.inbox');?></div></div>
<?php };?>