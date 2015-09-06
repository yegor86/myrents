<div id="full_container"><?php
$bcArr = array(
    'SEO поиска'
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'homeLink'=>CHtml::link('Главная','/admin/'),
    'links'=>$bcArr
)); 
 ?>




<table border="0" width="100%" cellpadding="0" height="100%" cellspacing="0"><tr><td class="center_container">
            <h2>SEO поиска</h2>

    

    <?php foreach ($langlist as $name=>$lang){?>
<?php
if($name=='Русский'){
    $mylang ='ru';
}elseif($name=='English'){
        $mylang ='en';
}else{
        $mylang = 'ua';
}
?><br><br>
            <?php echo '<h1>'.$name.'</h1><a href="/admin/seopage/add/'.$mylang.'" class="button"><b>Добавить</b></a><div class="clr"></div>';?>
            <table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort" id="sort_id">
    <th>Ссылка</th><th>Текст</th><th>Функции</th>
    <?php foreach ($lang as $seopage){?>
    <tr>
     <td width="28%"><?php echo CHtml::link($seopage->url, $seopage->url, array('target'=>'_blank'))?></td>
     <td><?php echo $seopage->content?></td>
     <td width="8%" align="center">
         <div class="instruments">
             <?php echo CHtml::link('<img src="/img_admin/edit.png">', '/admin/seopage/edit/'.$mylang.'/'.CustomFunctions::urlToParam($seopage->url));?>
         </div>
         </td>
    </tr>
    
    <?php }?>
        
</table>
    
    <?php }?>










    </td></tr></table></div>




