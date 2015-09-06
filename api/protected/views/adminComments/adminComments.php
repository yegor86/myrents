<div id="full_container"><?php
$bcArr = array(
    'Комментарии'
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'homeLink'=>CHtml::link('Главная','/admin/'),
    'links'=>$bcArr
)); 
 ?>
    
<script type="text/javascript">
checked=false;
function checkedAll (formid, val) {
	var form = document.getElementById('formid');
        if (checked == false){
            checked = true;
            $(val).html('Ни одного').addClass('un');
        } else {
            checked = false;
            $(val).html('Выделить все').removeClass('un');
        }
	for (var i =0; i < form.elements.length; i++) {
            form.elements[i].checked = checked;
	}
}
</script>



<table border="0" width="100%" cellpadding="0" height="100%" cellspacing="0"><tr><td class="center_container">
            <h2>Список комментарий</h2>
            <div class="pdd_10_0 clr"><span class="c_new_comment"><span></span>Новый комментарий (считается 3 дня)</span></div>
                    <?php if(count($commentlist)){?>
            
            <form id="formid" method="post">

    
    <div class="checked_delete"><input type="submit" value="Удалить" class="b_red" onclick="if(confirm('Удалить выделенное?')){return true;}else{return false;}" /></div>
    
    <span class="checkall" onclick="checkedAll('formid', this)">Выделить все</span>
    <div class="clr"></div>
            <table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort" id="sort_id">
    <th>ID</th><th>Дата</th><th>Аренда</th><th>Автор</th><th>Комментарий</th><th>Функции</th>
    

                <?php foreach ($commentlist as $comment) { ?>


 <?php if((time() - strtotime($comment->date))< Yii::app()->params['comment_isnew']) { $isnew = 'class="new"'; }else{ $isnew = '' ;}?>

        <tr id="<?php echo $comment->id?>" <?php echo $isnew?>>
     <td width="5%" align="center" <?php echo $isnew?>><?php echo $comment->id?></td>
     <td width="8%" align="center" <?php echo $isnew?>><?php echo $comment->date?></td>
     <td <?php echo $isnew?>><?php echo CHtml::link(''.$comment['receiver']->descriptions[0]->name.'', '/rent/'.$comment->receiver_id, array('target'=>'_blank'));?></td>
     <td <?php echo $isnew?>><?php echo CHtml::link(''.$comment['sender']->firstname.'<br/>'.$comment['sender']->lastname.'', '/user/'.$comment['sender']->id, array('target'=>'_blank'));?></td>
     <td width="40%" <?php echo $isnew?>><?php echo $comment->message?></td>
     <td width="7%" align="center" <?php echo $isnew?>><input type="checkbox" name="checked[]" value="<?php echo $comment->id?>" /> <a href="javascript:void(0);" onclick="deleteForm('<?php echo $comment->id?>', '/admin/comments/delete/<?php echo $comment->id?>', '')" title="Удалить"><img src="<?php echo $this->getAssetsUrl(); ?>/images/delete.png" alt="Удалить" /></a></td>
    </tr>


                <?php } ?>




</table>

            </form>
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
?>
                        <?php }else{ ?>
<div class="alarm info"><div>Нет информации</div></div>
 <?php } ?>
    </td></tr></table></div>



