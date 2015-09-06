<?php $this->renderPartial('messages_menu', array('type' => $type, 'user' => $user)); //полкдючение меню  ?>
<div id="subcontent">
    <?php $this->renderPartial('_messages', array('type' => $type, 'user' => $user, 'messages' => $messages, 'remessage' => $remessage)) ?>
</div>