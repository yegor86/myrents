
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0"><tr><td width="20%" valign="top" class="left_container">
<?php require 'leftmenu.php';?>
        </td><td width="80%" valign="top" class="right_container">
<h2>Окрестности</h2>
<table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort" id="sort_id">
    <th>ID</th><th>Название</th><th>Функции</th>
<?php foreach($neiborhoodlist as $neiborhood){ ?>
    <tr>
     <td width="5%" align="center"><?php echo $neiborhood->id;?></td>
     <td width="85%"><?php echo Yii::t('default',$neiborhood->name);?></td>
     <td width="10%" align="center"><?php echo CHtml::link('<img src="/img_admin/edit.png">', '/admin/filters/neiborhood/'.$neiborhood->id);?></td>
    </tr>
<?php } ?>
</table>


    </td></tr></table>