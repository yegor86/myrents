<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<ul class="big_auth">
	<?php foreach ($services as $name => $service) {
	    echo '<li class="auth-service '.$service->id.'">';
	    echo CHtml::link('', '/wlogin/'.$name, array('class' => $service->id));
	    echo '</li>';
 }?>
</ul>
<!--<a href="/login/vkontakte"  target="_blank" class="vk"></a></li><li><a target="_blank" href="/login/facebook" class="fb"></a>-->