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
<?php $this->widget('ext.widgets.UserTabsWidget.UserTabsWidget', array('user'=>$user,'view'=>'mypageMenu', 'activetab'=>'hostings'))?>
	
 <?php echo CHtml::link(Yii::t('default', 'edit.profile'), '/user/edit', array('class' => 'edit_profile_btn')) ?>

	    <div class="tab_content" style="padding:0;" id="subcontainer">
                
 <?php require '_mypage_how_place_top.php';?>

	    </div>

        <div class="pdd_10"></div>


  </div>  </div>
