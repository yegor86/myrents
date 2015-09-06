<div id="full_container"><?php
$bcArr = array(
    'Поддержка'
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'homeLink'=>CHtml::link('Главная','/admin/'),
    'links'=>$bcArr
)); 
 ?>




<table border="0" width="100%" cellpadding="0" height="100%" cellspacing="0"><tr><td class="center_container">
            <h2>Список комментарий</h2>
            <div class="pdd_10_0 clr"><span class="c_new_comment"><span></span>Новый комментарий (считается 3 дня)</span></div>


    
    <div class="checked_delete"><input type="submit" value="Удалить" class="b_red" onclick="if(confirm('Удалить выделенное?')){return true;}else{return false;}" /></div>
    

            <table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort" id="sort_id">
    <th>ID</th><th>Дата</th><th>Аренда</th><th>Автор</th><th>Комментарий</th><th>Функции</th>
    






</table>





    </td></tr></table></div>



