<?php
$cId = Yii::app()->controller->id;
$caId = Yii::app()->controller->action->id;
?>
<h1>&mdash; Пользователи:</h1>
<ul id="leftmenu">
    <li <?php if ($caId == 'adminUsers') echo 'class="active"' ?>><a href="/admin/user"><span class="icon user"></span>Список пользователей</a></li>
    <li <?php if ($caId == 'adminSingleNotify') echo 'class="active"' ?>><a href="/admin/user/notify"><span class="icon document"></span>Уведомление пользователю</a></li>
    <li <?php if ($caId == 'adminUsersEmailList') echo 'class="active"' ?>><a href="/admin/user/emailList"><span class="icon document"></span>Список почты</a></li>
</ul>