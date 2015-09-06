<h1>Объявления пользователя</h1>
<table border="0" width="100%"><tr><td width="20%" valign="top">
<?php require 'leftmenu.php';?>
        </td><td width="80%">
            
<table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort" id="sort_id">
    <th>ID</th><th>Название</th><th>Создатель</th><th>Функции</th>
<?php foreach($rentlist as $rent){ ?>
    <tr>
     <td><?php echo $rent->id;?></td>
     <td><?php echo $rent->descriptions[0]->name;?></td>
     <td><?php echo CHtml::link($rent->renter->firstname,'/admin/rent/user/'.$rent->renter->id) ?></td>
     <td><?php echo CHtml::link('view','/rent/'.$rent->id, array('target'=>'_blank')) ?></td>
    </tr>
<?php } ?>
</table>

	<?php
	$this->widget('ext.widgets.MRPaginator.MRPaginator', array(
	    'pages' => $pagination,
	    'maxButtonCount' => Yii::app()->params['maxbuttonCount'],
	    'header' => '',
	    'cssFile' => $this->getAssetsUrl() . '/css/pagination.css',
	    'skin' => 'myrents',
	              'firstPageLabel' => Yii::t('default','pagination.first.label'),
                                'lastPageLabel'  =>Yii::t('default','pagination.last.label')
	))
	?>
        </td></tr></table>
