
<?php
$cId = Yii::app()->controller->id;
$caId = Yii::app()->controller->action->id;

?>
<h1>&mdash; Фильтры:</h1>
<ul id="leftmenu">
    <li <?php if ($caId == 'adminMain') echo 'class="active"' ?>><a href="/admin/filters/amenities"><span class="icon document"></span>Удобства</a></li>
    <li <?php if ($caId == 'adminNeiborhood') echo 'class="active"' ?>><a href="/admin/filters/neiborhood"><span class="icon document"></span>Окрестности</a></li>
</ul>
