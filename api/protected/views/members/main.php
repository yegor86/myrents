<?php 
$this->pageTitle=Yii::t('default','Members');
?>

<script>
    
    
$(function () {

    $(window).scroll(function () {
        if ($(this).scrollTop() > 192) {
            $('.members_table_head').addClass('fixed');
        } else {
            $('.members_table_head').removeClass('fixed');
        }
    });

});
</script>
    
<div class="main one">
    <div class="mainhead">
        <div>
            <div>
                <div></div>
		<table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><h3 class="flt_l"><?php echo Yii::t('default','Members');?></h3></td></tr></table>
            </div>
        </div>
    </div>
    <div class="content">
        <div style="padding:0 0 5px 10px;">
        Показать: 
        <a href="javascript:void(0);" class="btn6 active"><?php echo Yii::t('default', 'all'); ?></a>
	<a href="javascript:void(0);" class="btn6"><?php echo Yii::t('default', 'Агенство'); ?></a>
        <a href="javascript:void(0);" class="btn6"><?php echo Yii::t('default', 'Риелторы'); ?></a>
        <a href="javascript:void(0);" class="btn6"><?php echo Yii::t('default', 'Частные лица'); ?></a>
</div>
        <div id="members_table_block">
            <div class="members_table_head">
                <div class="" style="margin-left: 50px;width:250px;">Имя</div>
                <div class="mem_type" style="padding:0;">Тип</div>
                <div class="mem_agency" style="padding:0;">Агенство</div>
                <div class="mem_rents" style="padding:0;">Объявлений</div>

            </div>

            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Независимый риелтор</div>
                <div class="mem_agency">-</div>
                <div class="mem_rents">15</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>

            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row agency_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/25.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
            <div class="members_table_row">
                <div class="mem_name">
                    <div class="user">
                        <a href="/user/"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR']?>little/noimage.jpg')"></span></a>
                    </div><a href="#">Семенов Андрей</a><br /><span class="city">Одесса</span>
                </div>
                <div class="mem_type">Представитель анегство</div>
                <div class="mem_agency"><a href="#">General motors</a></div>
                <div class="mem_rents">4564564</div>
                <div class="mem_send"><a href="#" class="btn6 active"><?php echo Yii::t('default', 'Написать'); ?></a></div>
            </div>
 
        
    </div>
</div>


