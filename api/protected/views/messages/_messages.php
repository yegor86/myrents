<script>init_scrollpane();</script>
<div id="loading">
    	    <div class="scroll-pane">
		<?php $this->renderPartial($type.'_messlist',array('type'=>$type,'user'=>$user,'messages'=>$messages,'remessage'=>$remessage)) ?>
    	    </div>
    </div>
