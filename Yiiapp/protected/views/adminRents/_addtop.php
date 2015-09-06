



<?php if($_POST['action']=='top'){
        $param = Yii::app()->params['smsTopPeriods'];
    }else{
        $param = Yii::app()->params['smsMainPeriods'];
    }
?>


<div id="days" style="padding: 0 10px">
    <div style="padding:5px 0;"><?php echo CHtml::activeLabel($topForm,'days'); ?></div>
    <div><?php echo CHtml::activeDropDownList($topForm,'days', MRChtml::tlistData($param, 'periodInDays', 'name'),array('empty'=>'--- Выбор ---'));?><?php echo CHtml::error($topForm,'days'); ?></div>
</div>






                

