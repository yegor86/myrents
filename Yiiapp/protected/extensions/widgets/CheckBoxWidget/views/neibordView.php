                                <div class="neiborhood_item">
    <?php echo $form->checkBox($model, '[' . $key . ']id', array('checked' => $checked, 'class'=>'flt_l')); ?>
                                    <label for="Neighbor_<?php echo $key?>_id" class="lab_checkbox"><?php echo Yii::t('default',$model->name)?></label>
                                </div>