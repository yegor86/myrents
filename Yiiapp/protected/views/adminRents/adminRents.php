

	
<script type="text/javascript">
calendar_ajax('/admin/rents/');
</script>
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0"><tr><td width="20%" valign="top" class="left_container">
<?php require 'leftmenu.php';?>
            <h3>Показать аренды:</h3>
            <div id="datepicker"></div>
        </td><td width="80%" class="right_container" valign="top">

<h2>Список объявлений</h2>
<form method="post">Поиск по ID: <input type="text" name="searchID" /> <input type="submit" value="Искать" class="b_blue" /></form>
<div id="ajax_request">
<table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort" id="sort_id">
    <th>ID</th><th>Название</th><th>Дата создания</th><th>Дата ред.</th><th  colspan="2">Статус</th><th>Владелец</th><th>Функции</th>
<?php foreach($rentlist as $rent){ ?>
<?php
$iscomp = ($rent->isCompleted()) ? '<img src="'.$this->assetsUrl.'/images/adm/on.png" alt="Заполнено" title="Заполнено" />' : '<img src="'.$this->assetsUrl.'/images/adm/off.png" alt="Не заполнено" title="Не заполнено" />';
?>

     <?php if((time() - strtotime($rent->creation_date))< Yii::app()->params['comment_isnew']) { $isnew = 'class="new"'; }else{ $isnew = '' ;}?>
	   <?php $inshow = ($rent->in_show) ? '<img src="'.$this->assetsUrl.'/images/adm/activate.png" alt="Показано" title="Показано" />' : '<img src="'.$this->assetsUrl.'/images/adm/inactive.png" alt="Скрыто" title="Скрыто" />';  ?>
    <tr>
     <td width="5%" align="center" <?php echo $isnew?>><?php echo $rent->id;?></td>
     <td width="50%" <?php echo $isnew?>><?php echo CHtml::link(preg_replace('/([\,\.])(?!\s)/ui', '$1 ', $rent->descriptions[0]->name),'/rent/'.$rent->id, array('target'=>'_blank'))?></td>
     <td width="15%" align="center" <?php echo $isnew?>><?php echo $rent->creation_date;?></td>
     <td width="15%" align="center" <?php echo $isnew?>><?php echo $rent->last_up;?></td>
     <td width="5%" align="center" <?php echo $isnew?>><?php echo $inshow;?></td>
     <td width="5%" align="center" <?php echo $isnew?>><?php echo $iscomp;?></td>
     <td width="10%" align="center" <?php echo $isnew?>><?php echo CHtml::link($rent->renter->firstname,'/user/'.$rent->renter->id ,array('class'=>'edit popEdge', 'title'=>Yii::t('default','edit'))) ?></td>
     <td width="10%" align="center" <?php echo $isnew?>><?php echo CHtml::link('<img src="/img_admin/edit.png">', '/rent/'.$rent->id.'/edit', array('target'=>'_blank','style'=>'float:left'));?><form method="post"><input type="hidden" name="DeleteRent[id]" value="<?php echo $rent->id?>"><input type="image" src="/img_admin/delete.png" onclick="if(confirm('Удалить пользователя \'<?php echo $rent->descriptions[0]->name?>\'?')){return true}else{return false} this.form.submit()"></form></td>
    </tr>
<?php } ?>
</table>



<?php
$this->widget('ext.widgets.MRPaginator.MRPaginator', array(
    'pages' => $pagination,
    'maxButtonCount' => Yii::app()->params['maxbuttonCount'],
    'header' => '',
    'cssFile' => $this->getAssetsUrl() . '/css/pagination_adm.css',
    'firstPageLabel' => '&laquo;',
    'lastPageLabel' => '&raquo;',
    'prevPageLabel'=>'Назад',
    'nextPageLabel'=>'Вперед',
))
?>   </div>
    </td></tr></table>