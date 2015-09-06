<?php
$this->pageTitle=$user['firstname'].'  '.$user['lastname'];
?>
            <script type="text/javascript">
                $('.uptop').fancybox({
                    'autoDimensions'	: false,
                    'padding'		: 0,
                    'autoScale':false,
                    'centerOnScroll':true,
                    'margin':5,
                    'showCloseButton':false,
                    'enableEscapeButton':false,
                    'scrolling'		: 'no'
                });
            </script>
                <script>
    $(function(){
       $('.reedmore').click(function(){
           $(this).toggleClass('active');
           $('#user_description').slideToggle(0);
       });
    });  
</script>
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
<?php $this->widget('ext.widgets.UserTabsWidget.UserTabsWidget', array('user'=>$user,'view'=>'mypageMenu', 'activetab'=>'hostings'))?>
	
 <?php echo CHtml::link(Yii::t('default', 'edit.profile'), '/user/edit', array('class' => 'edit_profile_btn')) ?>

	    <div class="tab_content" id="subcontainer">
                
 <?php require '_mypage_hostings.php';?>

	    </div>

        <div class="pdd_10"></div>


  </div>  </div>
