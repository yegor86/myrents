
    <?php
$this->pageTitle=$user['firstname'].'  '.$user['lastname'];
?>
 <div class="main one">
    <div class="mainhead">
      <div>
        <div>
          <div></div>
          <table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><?php echo Yii::t('default','your.profile') ?></td><td><a href="/search/" class="search_btn flt_r popEdge" title="<?php echo Yii::t('default','search.button');?>"></a></td></tr></table>
        </div>
      </div>
    </div>
    <div class="content">
<?php $this->widget('ext.widgets.UserTabsWidget.UserTabsWidget', array('user'=>$user,'view'=>'mypageMenu', 'activetab'=>'messages'))?>
	
 <?php echo CHtml::link(Yii::t('default', 'edit.profile'), '/user/edit', array('class' => 'edit_profile_btn')) ?>

	    <div class="tab_content" style="padding:0;">

		   <script>init_scrollpane();</script>

    	   <?php $this->renderPartial('messages_menu',array('type'=>'send','user'=>$user));//полкдючение меню ?>
                                                      <div id="subcontent">
                   <div id="loading">
    	    <div class="scroll-pane">
		<?php $this->renderPartial('_send',array('user'=>$user,'message'=>$message,'receiver'=>$receiver)) ?>
    	    </div>
    </div>

	</div>
	    </div>

        <div class="pdd_10"></div>


  </div>  </div>
<script type="text/javascript">
    $(function() {
        $(".flash-alert-success").fadeOut(10000);
	$('#send_message_form textarea').keyboard('ctrl+enter', function(e, bind) {
	    ajaxSubmitForm("#send_message_form","/user/<?php echo $this->user->id?>/messages/send/<?php echo $receiver->id?>", "#subcontent", "#load_box");
	    return false;
	});
    });
</script>