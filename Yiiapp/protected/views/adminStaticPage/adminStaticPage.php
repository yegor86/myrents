<div id="full_container">
<?php
$bcArr = array(
    'Страницы'
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'homeLink'=>CHtml::link('Главная','/admin/'),
    'links'=>$bcArr
)); 
 ?>     
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0"><tr><td width="100%" valign="top" class="center_container">
<h2>Страницы</h2>
<a href="/admin/staticpage/add" class="button"><b>Добавить</b></a>
                    <?php if(count($list)){?>
<table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort" id="sort_id">
    <th>ID</th><th>Название</th><th>Функции</th>
    
    

                <?php foreach ($list as $page) { ?>
                    <?php foreach ($page['translations'] as $trans) { ?>
    
    
        <tr id="<?php echo $page->id?>">
     <td width="5%" align="center"><?php echo $page->id?></td>
     <td><?php echo CHtml::link($trans->name, '/staticpage/'.$page->alias, array('target'=>'_blank'))?></td>
     <td width="10%" align="center"><?php echo CHtml::link('<img src="/img_admin/edit.png">', '/admin/staticpage/edit/'.$page->id);?> <a href="javascript:void(0);" onclick="deleteForm('<?php echo $page->id?>', '/admin/staticpage/delete/<?php echo $page->id?>', '<?php echo $trans->name?>')"><img src="/img_admin/delete.png" alt="" /></a></td>
    </tr>
    
    

                    <?php } ?>
                <?php } ?>

                        
                        



</table>

                        <?php }else{ ?>
<div class="alarm info"><div>Нет информации</div></div>
 <?php } ?>

    </td></tr></table>
    
</div>


