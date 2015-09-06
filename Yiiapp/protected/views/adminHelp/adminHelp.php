<div id="full_container"><?php
$bcArr = array(
    'Помощь'
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'homeLink'=>CHtml::link('Главная','/admin/'),
    'links'=>$bcArr
)); 
 ?>   
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0"><tr><td width="100%" valign="top" class="center_container">
<h2>Список помощи</h2>
<a href="/admin/help/add" class="btn"><b>Добавить</b></a>
                    <?php if(count($helplist)){?>
<table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort" id="sort_id">
    <th>ID</th><th>Название</th><th>Функции</th>
    
    

                <?php foreach ($helplist as $help) { ?>
                    <?php foreach ($help['translations'] as $trans) { ?>
    
    
        <tr id="<?php echo $help->id?>">
     <td width="5%" align="center"><?php echo $help->id?></td>
     <td><?php echo CHtml::link($trans->name, '/help/'.$help->alias, array('target'=>'_blank'))?></td>
     <td width="10%" align="center"><?php echo CHtml::link('<img src="/img_admin/edit.png">', '/admin/help/edit/'.$help->id);?> <a href="javascript:void(0);" onclick="deleteForm('<?php echo $help->id?>', '/admin/help/delete/<?php echo $help->id?>', '')"><img src="/img_admin/delete.png" alt="" /></a></td>
    </tr>
    
    

                    <?php } ?>
                <?php } ?>

                        
                        



</table>
                        <?php }else{ ?>
<div class="alarm info"><div>Нет информации</div></div>
 <?php } ?>

    </td></tr></table></div>