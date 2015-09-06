<div>
    
<?php echo $form->checkBox($model,'['.$key.']id',  array('checked'=>$checked, 'class'=>'amenity')); ?>
<label for="Amenity_<?php echo $key?>_id"  imgname="<?php echo $this->assetsUrl.'/images/'.$model->image?>"><?php echo Yii::t('default',$model->name)?></label>
</div>