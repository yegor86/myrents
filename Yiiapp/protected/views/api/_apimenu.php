<ul class="tabs">
    <li <?php if(Yii::app()->controller->action->id == 'index'){ echo "class='active'";}?>><?php echo CHtml::link(Yii::t('api','get.homepage'),'/api/'.$_GET['apikey']);?></li>
    <li><?php echo CHtml::link(Yii::t('api','get.xml'),'/api/rentlist/'.$_GET['apikey']);?></li>
    <li><?php echo CHtml::link(Yii::t('api','get.xml.ids'),'/api/rentids/'.$_GET['apikey']);?></li> 
    <li <?php if(Yii::app()->controller->action->id == 'documentation'){ echo "class='active'";}?>><?php echo CHtml::link(Yii::t('api','get.documentation'),'/api_documentation', array('target'=>'_blank'));?></li> 
</ul> 
