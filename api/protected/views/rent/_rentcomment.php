<script type="text/javascript">
    $(function() {
        $(".flash-alert-success").fadeOut(10000);
	$('#rent-comment-form textarea, #rent-comment-form input').keyboard('ctrl+enter', function(e, bind) {
	    ajaxSubmitForm("#rent-comment-form","/rent/<?php echo $rent->id?>", "#commenstlist", "#load_box");
	    return false;
	});
    });
</script>

<div>
    <?php if (!count($commentsList['comments'])) { ?>
        <div class="pdd_5 no_component"><?php echo Yii::t('default', 'bill hasn`t comments') ?></div>

    <?php } else foreach ($commentsList['comments'] as $comment) { ?>
	    <div class="post" style="padding-bottom:0;">

		<?php
		if (file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->params['USERPHOTOSDIR'] . Yii::app()->params['THUMBDIR'] . $comment->sender->image)) {
		    $avatar = CHtml::link('<span style="background-image:url(\'' . Yii::app()->params['USERPHOTOSDIR'] . Yii::app()->params['THUMBDIR'] . $comment->sender->image . '\')"></span>', '/user/' . $comment->sender_id, array('class' => 'avatar_img_box'));
		} else {
		    $avatar = CHtml::link('<span style="background-image:url(\'/uploads/userpic/noimage_small.png\')"></span>', '/user/' . $comment->sender_id, array('class' => 'avatar_img_box'));
		}
		?>


		<div class="flt_l">

	<?php echo $avatar ?>
		    <div class="cdate"><?php echo substr($comment->date, 0, strlen($comment->date) - 9); ?></div>
		</div>
		<div class="ctext"><a class="link" href="/user/<?php echo $comment->sender_id; ?>"><?php echo $comment->sender->firstname . ' '
	. $comment->sender->lastname
	?></a>
		    <pre><?php echo CHtml::encode($comment->message) ?></pre>
		</div>
		<div class="clr"></div>
	    </div>
	<?php } ?>
	    
	<?php
	$this->widget('ext.widgets.MRPaginator.MRPaginator', array(
	    'pages' => $commentsList['pagination'],
	    'maxButtonCount' => Yii::app()->params['maxbuttonCount'],
	    'header' => '',
	    'cssFile' => $this->getAssetsUrl() . '/css/pagination.css',
	    'skin' => 'myrents',
	              'firstPageLabel' => Yii::t('default','pagination.first.label'),
                                'lastPageLabel'  =>Yii::t('default','pagination.last.label')
	))
	?>
    <div class="clr"></div>
</div>
<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="flash-alert-success">
	<?php echo Yii::app()->user->getFlash('success') ?>
    </div>
    <?php endif ?>

    <?php if ($this->user && $this->user->active) { ?>

    <div class="addcomment">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
	    'id' => 'rent-comment-form',
	    'enableAjaxValidation' => false,
	    'htmlOptions' => array('name' => 'add_comment')
		));
	?>
	
	
    <div id="msg_com_div"><?php echo $form->error($AddComment, 'message'); ?> 
	    <?php echo $form->textArea($AddComment, 'message', array('rows' => 40, 'cols' => 40, 'class' => 'comm_textarea')); ?>
	        </div><div class="pdd_5"></div>




        <div class="flt_l">
            
            <?php if(extension_loaded('gd') ){?>
                <?php echo $form->label($AddComment, 'verifyCode')?>:
        <div class="captcha">

    <div class="code"><?php $this->widget('CCaptcha',array(
	'showRefreshButton'=>true,
	'clickableImage'=>false,
	'buttonLabel'=>'<img src="'.$this->assetsUrl.'/images/refresh_captcha.png" alt="" title="'.Yii::t("default","AR.RentComment.capcha.refresh").'">'
    ))?></div>
    <?php echo $form->error($AddComment,'verifyCode'); ?><?php echo CHtml::activeTextField($AddComment, 'verifyCode')?>
     <?php $this->endWidget(); ?>
        </div><div class="clr"></div>

<?php }?>
            


        </div>

                        <div class="flt_r formdesc" style="text-align:right;"><?php echo Yii::t('default', 'enter or shift+enter') ?>
                        <div class="clr"></div> <div class="pdd_5"></div>
                                <div><span id="load_box" style="display:none"><img src="<?php echo $this->assetsUrl;?>/images/s-loading.gif" border="0" alt=""></span>
<?php
    echo CHtml::link('<span><b><i>' . Yii::t('default', 'Send message') . '</i></b></span>', 'javascript:void(0)', array(
	'class' => 'btn_border abutton yellow',

	'onClick' => 'ajaxSubmitForm("#rent-comment-form","/rent/' . $rent->id . '", "#commenstlist", "#load_box");'
    ))
    ?></div>
                        
                        
                        </div>
        <div class="clr"></div>
        <div class="pdd_5"></div>
    </div>
<?php } ?>
