<div id="full_container"><?php
$bcArr = array(
    'Партнеры'
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'homeLink'=>CHtml::link('Главная','/admin/'),
    'links'=>$bcArr
)); 
 ?>   

<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0"><tr><td width="100%" valign="top" class="center_container">
  <h2>Партнеры</h2>         <a href="/admin/partners/add" class="btn b_green add "><b>Добавить</b></a>
                      <?php if(count($partnerslist)){?>
<table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort" id="sort_id">
    <th>ID</th><th>Изображение</th><th>Название</th><th>Функции</th>
    
    

                <?php foreach ($partnerslist as $partner) { ?>
                    <?php foreach ($partner['translations'] as $trans) { ?>
    
    
        <tr id="<?php echo $partner->id?>">
     <td width="5%" align="center"><?php echo $partner->id?></td>
     <td width="15%" align="center"><img src="/uploads/partners/<?php echo $partner->image?>" width="140" height="90" border="0" alt="<?php echo $trans->name?>" /></td>
     <td width="60%"><?php echo $trans->name?></td>
     <td width="10%" align="center"><?php echo CHtml::link('<img src="/img_admin/edit.png">', '/admin/partners/edit/'.$partner->id);?> <a href="javascript:void(0);" onclick="deleteForm('<?php echo $partner->id?>', '/admin/partners/delete/<?php echo $partner->id?>', '<?php echo $trans->name?>')"><img src="/img_admin/delete.png" alt="" /></a></td>
    </tr>
    
    

                    <?php } ?>
                <?php } ?>

                        
                        



</table>
                        <?php }else{ ?>
                            <div class="alarm info"><div>Нет информации</div></div>
                       <?php  } ?>

    </td></tr></table></div>