<?php if(Yii::app()->user->hasFlash('error')){
$this->pageTitle=Yii::t('default',Yii::app()->user->getFlash('error'));

}
else $this->pageTitle=Yii::t('default','loginpage title');
?>



<div class="main one">
    		<?php $this->widget('application.extensions.login.XLoginPortlet', array('visible' => Yii::app()->user->isGuest,'fullsize'=>true)); ?>
    

</div>













