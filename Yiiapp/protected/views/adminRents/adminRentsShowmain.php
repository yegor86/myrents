<table border="0" width="100%" cellpadding="0" height="100%" cellspacing="0"><tr><td width="20%" valign="top" class="left_container">
<?php require 'leftmenu.php';?>
            

<h2 id="addtop">Добавить объявление в ТОП</h2>


            <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'editrent',
	'clientOptions'=>array(
	'validateOnSubmit'=>true
	),
        'htmlOptions'=>array('name'=>'editrent')
)); ?>

                  <script>
                $(function(){
               /*     
           $("#addtop").click(function() {
                $( "#dialog_addtop" ).dialog( "open" );
            });
            $( "#dialog_addtop" ).dialog({
            autoOpen: false,
            height: 300,
            width: 350,
            modal: true
        });*/

                $('#to').change(function(){
                    
                    if($(this).val()=='m'){
                        $('#days_top').hide();
                        $('#days_main').show();
    $.ajax({
        type: 'POST',
	data:{action: 'main'},
	success:function(resultdata) {
            $('#ajax_addtop').html(resultdata);
        }
    });

                    }else{
                        $('#days_main').hide();
                        $('#days_top').show();
                            $.ajax({
                                type: 'POST',
                            
	data:{action: 'top'},
	success:function(resultdata) {
            $('#ajax_addtop').html(resultdata);
        }
    });
                    }
                });
                });
            </script>      
<div style="padding: 0 10px">
    <div style="padding:5px 0;"><?php echo $form->labelEx($topForm,'rent_id'); ?></div>
    <div><?php echo $form->textField($topForm,'rent_id',array('style'=>'width:200px;'));?><?php echo $form->error($topForm,'rent_id'); ?></div>
</div>
<div style="padding: 0 10px">
    <div style="padding:5px 0;"><?php echo $form->labelEx($topForm,'to'); ?></div>
    <div><?php echo $form->dropDownList($topForm,'to', array('m'=>'На главную', 't'=>'В поиск'),array('empty'=>'--- Выбор ---', 'id'=>'to'));?><?php echo $form->error($topForm,'to'); ?></div>
</div>
<div id="ajax_addtop">


</div>

            <div style="padding:5px 10px;"><?php echo CHtml::submitButton('ОК',array('class'=>'b_green'));?></div>
            
               <?php $this->endWidget(); ?>
            </div>
            
            
        </td><td width="80%" valign="top" class="right_container">
<h2>Объявления выводимые на главной</h2>
<?php if(count($rentTopMain)){?>
<table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort" id="sort_id">
    <th>ID</th><th>Название</th><th>Дата: доб/конец</th><th>Тип</th><th>Функции</th>
<?php foreach($rentTopMain as $renttopmain){?>


                
    <tr>
    <td width="8%" align="center"><?php echo $renttopmain->id ?></td>
    <td width="50%"><?php echo CHtml::link($renttopmain->descriptions[0]->name, '/rent/'.$renttopmain->id, array('target'=>'_blank')); ?></td>
    <td width="20%" align="center" style="font-size: 10px;"><?php echo date("d-m-Y H:i:s",  strtotime($renttopmain->atmain->start))?><br><?php echo date("d-m-Y H:i:s",  strtotime($renttopmain->atmain->end))?></td>
    <td width="10%" align="center"><?php echo ($renttopmain->todo==2) ? 'Продажа':'Сдача' ; ?></td>
    <td width="12%" align="center">
          <div class="instruments">
              <form method="post" id="TopMainDelete<?php echo $renttopmain->id ?>" style="display: none">
                  <input type="hidden" name="Delete[id]" value="<?php echo $renttopmain->id?>">
                  <input type="hidden" name="Delete[action]" value="m">
              </form>
             <?php echo CHtml::link('<img src="/img_admin/delete.png">', 'javascript:void(0)', array('onClick'=>'if(confirm("Удалить объявление?")){$("#TopMainDelete'.$renttopmain->id.'").submit();}else{return false} '));?>
         </div>
    </td>
    </tr>
<?php }?>
</table>
<?php }else{ ?>
<div class="alarm info"><div>Нет информации</div></div>
<?php } ?>
<h2>Объявления выводимые в поиске</h2>
<?php if(count($rentTop)){?>
<table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort" id="sort_id">
    <th>ID</th><th>Название</th><th>Дата: доб/конец</th><th>Тип</th><th>Функции</th>
<?php foreach($rentTop as $renttop){?>
    <tr>
    <td width="8%" align="center"><?php echo $renttop->id ?></td>
    <td width="50%"><?php echo CHtml::link($renttop->descriptions[0]->name, '/rent/'.$renttop->id, array('target'=>'_blank')); ?></td>
    <td width="20%" align="center" style="font-size: 10px;"><?php echo date("d-m-Y H:i:s",  strtotime($renttop->top->start))?><br><?php echo date("d-m-Y H:i:s",  strtotime($renttop->top->end))?></td>
    <td width="10%" align="center"><?php echo ($renttop->todo==2) ? 'Продажа':'Сдача' ; ?></td>
    <td width="12%" align="center">
          <div class="instruments">
              <form method="post" id="TopDelete" style="display: none">
                  <input type="hidden" name="Delete[id]" value="<?php echo $renttop->id?>">
                  <input type="hidden" name="Delete[action]" value="t">
              </form>
             <?php echo CHtml::link('<img src="/img_admin/delete.png">', 'javascript:void(0)', array('onClick'=>'if(confirm("Удалить объявление?")){$("#TopDelete").submit();}else{return false} '));?>
         </div>
    </td>
    </tr>
<?php }?>
</table>
<?php }else{ ?>
<div class="alarm info"><div>Нет информации</div></div>
<?php } ?>
    </td></tr></table>