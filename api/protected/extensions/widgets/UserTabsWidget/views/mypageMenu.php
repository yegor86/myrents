<ul class="tabs">
    <li <?php if ($activetab == 'info') echo('class="active"') ?> id="infoajax"><?php echo MRChtml::ajaxLink(Yii::t('default', 'usermenu.info'), '/user/' . $id . '/info',array('update' => '#subcontainer','updateUrl' => true, 'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:50px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>', 'type' => 'post', 'data' => array('ajax' => true)), 
		array('href'=>'/user/' . $id . '/info') ); ?></li>
     <li <?php if ($activetab == 'messages') echo('class="b_active"') ?> id="messagesajax"><?php echo Chtml::link(Yii::t('default', 'usermenu.messages'), '/user/' . $id . '/messages')?></li>
    <li <?php if ($activetab == 'hostings') echo('class="b_active"') ?> id="boardajax"><?php echo MRChtml::ajaxLink(Yii::t('default', 'usermenu.bills'), '/user/' . $id . '/hostings', array('update' => '#subcontainer','updateUrl' => true, 'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:50px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>', 'type' => 'post', 'data' => array('ajax' => true)), 
		array('href'=>'/user/' . $id . '/hostings')); ?></li>
     <!--<li <?php if ($activetab == 'friends') echo('class="active"') ?> id="friendsajax"><?php echo MRChtml::ajaxLink(Yii::t('default', 'usermenu.friends'), '/user/' . $id . '/friends', array('update' => '#subcontainer','updateUrl' => true, 'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:50px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>', 'type' => 'post', 'data' => array('ajax' => true)), 
		array('href'=>'/user/' . $id . '/friends')); ?></li>-->
    <li <?php if ($activetab == 'favorites') echo('class="active"') ?> id="favoritesajax"><?php echo MRChtml::ajaxLink(Yii::t('default', 'usermenu.favorites'), '/user/' . $id . '/favorites', array('update' => '#subcontainer','updateUrl' => true, 'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:50px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>', 'type' => 'post', 'data' => array('ajax' => true)), 
		array('href'=>'/user/' . $id . '/favorites')); ?></li>
</ul> 

<script type="text/javascript">

$(function(){
    $('.tabs li#infoajax, .tabs li#favoritesajax').on('click', function() {
       $('.tabs li').removeClass('active').removeClass('b_active');
       $(this).addClass('active');
  });
     $('.tabs li#boardajax, .tabs li#messagesajax').on('click', function() {
       $('.tabs li').removeClass('b_active').removeClass('active');
       $(this).addClass('b_active');
  });

});

</script>



<script type="text/javascript">

$(function(){
    $('.sub_tabs li').on('click', function() {
        $('.sub_tabs li').removeClass('active');
        $(this).addClass('active');
  });

    $('.sub_tabs li .del').on('click', function() {

        $(this).parent().remove();
  });
});

</script>
