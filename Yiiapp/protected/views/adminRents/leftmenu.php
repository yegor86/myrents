<?php
$cId = Yii::app()->controller->id;
$caId = Yii::app()->controller->action->id;
?>
<h1>&mdash; Объявления:</h1>
<ul id="leftmenu">
    <li <?php if ($caId == 'adminRents') echo 'class="active"' ?>><a href="/admin/rents"><span class="icon user"></span>Список объявлений</a></li>
    <li <?php if ($caId == 'adminRentsShowmain') echo 'class="active"' ?>><a href="/admin/rents/showmain"><span class="icon document"></span>Список объявлений на главной</a></li>
</ul>