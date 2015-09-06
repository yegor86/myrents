        <ul class="tabs">
          <li <?php if($activetab == 'info') echo('class="active"')?> id="ajax_user_info"><?php echo MRChtml::ajaxLink(Yii::t('default', 'usermenu.info'), '/user/' . $id . '/info', array('update' => '#subcontent', 'updateUrl' => true, 'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:340px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>','type' => 'post')); ?></li>
          <li <?php if($activetab == 'feedback') echo('class="active"')?> style="display:none"><a href="#feedback">Feedback</a></li>
          <li <?php if($activetab == 'hostings') echo('class="active"')?> id="ajax_user_board"><?php echo MRChtml::ajaxLink(Yii::t('default', 'usermenu.bills'),'/user/' . $id . '/hostings',array('update' => '#subcontent', 'updateUrl' => true, 'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:340px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>','type' => 'post')); ?></li>
        </ul>

<script type="text/javascript">

$(function(){
    $('.tabs li').click(function() {
       $('.tabs li').removeClass('active');
       $(this).addClass('active');
  });

});

</script>