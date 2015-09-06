<li id="authorization"><?php echo CHtml::link(Yii::app()->user->name . ' <span class="trans_txt"></span>', '/user/' . Yii::app()->user->id, array('class' => 'menu_h_border mlink trans','onclick'=>'return false','style'=>'width: 112px;')) ?>
   <div id="authorization_pop"><div class="free_layer"></div>
        
        <div class="popup_box" style="width: 160px">
            <div id="close_user_list_pop"><?php echo CHtml::link('<span class="trans">'.Yii::app()->user->name . '<span class="trans_txt"></span></span> ', '/user/' . Yii::app()->user->id, array('class' => ' trasns','onclick'=>'return false')) ?></div>
            <div><?php echo CHtml::link(Yii::t('default', 'usermenu.bills'), '/user/' . Yii::app()->user->id . '/hostings') ?></div>
	    <?php $count = isset($this->controller->user->not_readed_mail)?count($this->controller->user->not_readed_mail):0;
	    $mailcount=$count?" ($count)":'';?>
            <div><?php echo CHtml::link(Yii::t('default', 'usermenu.message').$mailcount, '/user/' . Yii::app()->user->id . '/messages') ?></div>
            <div><?php echo CHtml::link(Yii::t('default', 'usermenu.profile'), '/user/' . Yii::app()->user->id.'/info') ?></div>
            <div class="last"><?php echo CHtml::link(Yii::t('default', 'exit'), '/logout') ?></div>
        </div>
    </div>
</li>