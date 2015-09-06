
<?php $this->renderPartial('_menu',array('selflink'=>$selflink)) ?>

        <div id="members_table_block">
            <div class="members_table_head">
                <div class="" style="margin-left: 50px;width:250px;">Имя</div>
                <div class="mem_type" style="padding:0;">Тип</div>
                <div class="mem_agency" style="padding:0;">Агенство</div>
                <div class="mem_rents" style="padding:0;">Объявлений</div>

            </div>
	    <?php foreach ($users as $user) {?>
	    
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div>
		   <?php echo CHtml::link($user->firstname.' '.$user->lastname, '/user/'.$user->id) ?>
		    <?php //<br /><span class="city">Одесса</span>?>
                </div>
                <div class="mem_type">
		    <?php
		    $renterType = 'rentertype.user';
		    if(!$user->is_renter&&$user->fullRentsCount){
			$renterType = 'rentertype.private.renter';
		    }elseif(!$user->is_renter){
			$renterType = 'rentertype.user';
		    }elseif($user->is_renter&&$user->agencyCount){
			$renterType = 'rentertype.agency.renter';
		    }else{
			$renterType = 'rentertype.free.renter';
		    };
		    echo Yii::t('default',$renterType);
		    ?>
		    </div>
                <div class="mem_agency">
		    <?php foreach ($user->validAgencies as $agency){
			echo CHtml::link($agency->description->name, '/agency/'.$agency->id);
		     }?>
		</div>
                <div class="mem_rents"><?php echo $user->fullRentsCount ?></div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>

<?php }?>

