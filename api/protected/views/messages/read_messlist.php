
    <div class="message_box">
        <div class="post">
    	<div class="flt_l">
		<?php
		$avatarImage = (file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] . "userpic/thumbs/" . $messages[0]->sender->image)) ? '/uploads/userpic/thumbs/' . $messages[0]->sender->image : '/uploads/userpic/thumbs/noimage.jpg';

		echo CHtml::link('<span style="background-image:url(\'' . $avatarImage . '\')"></span>', '/user/' . $messages[0]->sender->id, array('class' => 'avatar_img_box'));
		?>

    	    <div class="cdate"><?php echo $messages[0]->date ?></div>
    	</div>
    	<div class="ctext" style="padding-top:10px;">
		<?php echo CHtml::link($messages[0]->sender->firstname . ' ' . $messages[0]->sender->lastname, '/user/' . $messages[0]->sender->id, array('class' => 'link')) ?>
		<?php echo CHtml::ajaxLink('', "javascript:void(0);", array(), array('class' => 'flt_r del', 'style' => 'display:block;')) ?>
    	    
	    <pre><?php echo $messages[0]->message ?></pre>
    	</div><div class="clr"></div>
        </div>

    </div>

    <div class="addcomment">
<?php
	$form = $this->beginWidget('CActiveForm', array(
	    'id' => 'send_message_form',
	    'enableAjaxValidation' => false,
	    'htmlOptions' => array('name' => 'add_comment')
		));
	?>

	
    <div id="msg_com_div"><?php echo $form->error($remessage, 'message'); ?> 
	    <?php echo $form->textArea($remessage, 'message', array('rows' => 40, 'cols' => 40, 'class' => 'comm_textarea')); ?>
	        </div><div class="pdd_5"></div>



<?php
    echo CHtml::link('<span><b><i>' . Yii::t('default', 'Send message') . '</i></b></span>', 'javascript:void(0)', array(
	'class' => 'btn_border abutton yellow',
	'onClick' => 'ajaxSubmitForm("#send_message_form","/user/'.$this->user->id.'/messages/'. $messages[0]->id . '", "#subcontent", "#load_box");'
    ))
    ?>
     <?php $this->endWidget(); ?>
    </div>