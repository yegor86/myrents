<ul class="big_auth">
	<?php foreach ($services as $name => $service) {
	    echo '<li class="auth-service '.$service->id.'">';
	    echo CHtml::link('', '/wlogin/'.$name, array('class' => $service->id));
	    echo '</li>';
 }?>
</ul>