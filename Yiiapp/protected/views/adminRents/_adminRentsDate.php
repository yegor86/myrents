    <?php echo '<span style="float:right">Количество: '.count($rentlist).'</span><div class="clr"></div>';?>
    <?php if(count($rentlist)){?>


<table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort" id="sort_id">
    <th>ID</th><th>Название</th><th>Дата создания</th><th>Владелец</th><th>Функции</th>

<?php foreach($rentlist as $rent){ ?>
    <tr>
     <td width="5%" align="center"><?php echo $rent->id;?></td>
     <td width="45%"><?php if(isset($rent->descriptions[0]))echo preg_replace('/([\,\.])(?!\s)/ui', '$1 ', $rent->descriptions[0]->name);?></td>
     <td width="15%" align="center"><?php echo $rent->creation_date;?></td>
     <td width="10%" align="center"><?php echo CHtml::link($rent->renter->firstname,'/user/'.$rent->renter->id ,array('class'=>'edit popEdge', 'title'=>Yii::t('default','edit'))) ?></td>
     <td width="10%" align="center"><form method="post"><input type="hidden" name="DeleteRent[id]" value="<?php echo $rent->id?>"><input type="image" src="/img_admin/delete.png" onclick="if(confirm('Удалить пользователя \'<?php echo $rent->descriptions[0]->name?>\'?')){return true}else{return false} this.form.submit()"></form> <?php echo CHtml::link('<img src="/img_admin/edit.png">', '/rent/'.$rent->id.'/edit');?></td>
    </tr>
<?php } ?>

</table>
<?php }else{ ?>
<center><span class="not-found"></span></center>
<?php } ?>


