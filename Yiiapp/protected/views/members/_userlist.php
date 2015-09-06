
<?php $this->renderPartial('_menu',array('selflink'=>$selflink)) ?>

        <div id="members_table_block">
            <div class="members_table_head">
                <div class="" style="margin-left: 50px;width:250px;"><?php echo Yii::t('default','name')?></div>
<?php if ((Yii::app()->request->isAjaxRequest && $selflink=='/members') || (!Yii::app()->request->isAjaxRequest && ($selflink=='/members' || !$selflink=='/members/realtors' || !$selflink=='/members/agency' || !$selflink=='/members/private'))) {?><div class="mem_type" style="padding:0;"><?php echo Yii::t('default','bill type')?></div><?php }?>
                <div class="mem_rents" style="padding:0;"><?php echo Yii::t('default','member.board')?></div>

            </div>
	    <?php foreach ($users as $user) {?>
	    
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/<?php echo $user->id?>"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/<?php echo $user->image?>')"></span></a>
                    </div>
		   <?php echo CHtml::link($user->firstname.' '.$user->lastname, '/user/'.$user->id) ?>
		    <?php //<br /><span class="city">Одесса</span>?>
                </div>
<?php if ((Yii::app()->request->isAjaxRequest && $selflink=='/members') || (!Yii::app()->request->isAjaxRequest && ($selflink=='/members' || !$selflink=='/members/realtors' || !$selflink=='/members/agency' || !$selflink=='/members/private'))) {?>
                <div class="mem_type">
		    <?php
		    echo Yii::t('default','rentertype.'.$user->rentertype);
		    ?>
		    </div>
                <?php }?>
                <div class="mem_rents"><?php echo $user->fullRentsCount ?></div>
		<?php if (!Yii::app()->user->isGuest){?>
                <div class="mem_send"><?php echo CHtml::link(Yii::t('default','to.write'), '/messages/send/'.$user->id, array('class'=>'btn6 active'));?></div>
		<?php }else{?>
                <div class="mem_send"><?php echo CHtml::link(Yii::t('default','to.write'), '/register', array('class'=>'btn6 active'));?></div>
                <?php }?>
            </div>
	    

<?php }?>

	</div>

            <div style="margin-top:20px;">
    	<?php
	$this->widget('ext.widgets.MRPaginator.MRAjaxPaginator', array(
	    'pages' => $pagination,
	    'return'=>'#content',
	    'maxButtonCount' => Yii::app()->params['maxbuttonCount'],
	    'header' => '',
	    'cssFile' => $this->getAssetsUrl() . '/css/pagination.css',
	    'skin' => 'myrents',
	    'userfulUrl'=>$selflink,
                	              'firstPageLabel' => Yii::t('default','pagination.first.label'),
                                'lastPageLabel'  =>Yii::t('default','pagination.last.label')
	))
	?></div>