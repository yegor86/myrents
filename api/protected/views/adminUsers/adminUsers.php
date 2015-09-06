<script type="text/javascript">
calendar_ajax('/admin/user/');
</script>
<table border="0" width="100%" width="100%" cellpadding="0" cellspacing="0"><tr><td width="20%" valign="top" class="left_container">
<?php require 'leftmenu.php';?>
             <h3>Показать пользователей:</h3>
            <div id="datepicker"></div>
        </td><td width="80%" class="right_container" valign="top">
           <h2>Список пользователей</h2>
            <form name="sortUser" method="post">Сортировка <select name="sortRole" onChange="this.form.submit()"><option>---</option><option value="writter">Пользователи</option><option value="moderator">Модераторы</option><option value="admin">Администраторы</option><option value="banned">Забаненые</option></select></form>
            
            
            
            <form name="searchUser" method="post">
                Поиска по: <select name="searchUser[type]" style="width:100px">
                    <option>---</option>
                    <option value="id">ID</option>
                    <option value="firstname">Имени</option>
                    <option value="email">E-mail</option>
                    <option value="lastname">Фамилии</option>
                </select> <input type="text" name="searchUser[string]"  style="width:200px" />

                <input type="submit" value="Искать" class="b_green" />
            </form>
 <div id="ajax_request">
<table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort" id="sort_id">
    <th>ID</th><th>Аватар</th><th>Имя</th><th>Почта</th><th>Дата регистрации</th><th>Дата пос. активности</th><th>Функции</th>
<?php foreach($userlist as $user){ ?>
         <?php if((time() - strtotime($user->member_since))< Yii::app()->params['comment_isnew']) { $isnew = 'class="new"'; }else{ $isnew = '' ;}?>
    <tr>
     <td align="center" <?php echo $isnew?>><?php echo $user->id;?></td>
     <td align="center" <?php echo $isnew?>><?php if (file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] .  "userpic/" . $user['image'])) {
                        echo '<a href="/user/'.$user->id.'"><span class="avatar_img_box" style="background-image:url(\'/uploads/userpic/little/'.$user['image'].'\'); background-position: center center; background-repeat:no-repeat;background-color:#fff;"></span></span></a>';
		    } else {
                        echo '<a href="/user/'.$user->id.'"><span class="avatar_img_box" style="background-image:url(\'/uploads/userpic/little/smaill_no-avatar.png\'); background-position: center center; background-repeat:no-repeat;background-color:#fff;"></span></span></a>';
		    }
		    ?></td>
     <td <?php echo $isnew?>><a OnMouseOver="Tip('<div style=\'width: 500px;\' class=\'tiptip_box\'><b><?php echo $user->firstname.' '.$user->lastname;?></b><br><br><b>Контакты:</b><br>Skype: <?php echo $user->skype;?><br>Телефоны: <br><?php echo CustomFunctions::slashNtoBR($user->phone)?><br><br><b>Описание</b><br><?php echo $user->overview;?></div>')" href="/user/<?php echo $user->id;?>"><?php echo $user->firstname.' '.$user->lastname;?></a> <?php if($user->role=='admin') echo '(Администратор)'; elseif($user->role=='moderator') echo '(Модератор)';?></td>
     <td <?php echo $isnew?>>
         <?php
        // if(preg_match('#(\d+)#s', $user->nick, $fb)) echo '<a href="http://vk.com/id'.$fb[0].'">Facebook</a>';
         if(preg_match("/vkontakte/i",$user->nick)){
             preg_match('#(\d+)#s', $user->nick, $vk);
             echo '<a href="http://vk.com/id'.$vk[0].'" target="_blank">В контакте</a>';
         }
         if(preg_match("/facebook/i",$user->nick)){
             preg_match('#(\d+)#s', $user->nick, $fb);
             echo '<a href="http://www.facebook.com/profile.php?id='.$fb[0].'" target="_blank">Facebook</a>';
         }

         if($user->email) echo $user->email;
         
         ?></td>
     
     <td align="center" <?php echo $isnew?>><?php $reg_ex = explode(' ',$user->member_since); echo $reg_ex[0]?></td>
     <td align="center" <?php echo $isnew?>><?php echo($user->last_worked);?></td>

     <td align="center" <?php echo $isnew?>><?php echo CHtml::link('<img src="/img_admin/edit.png">', '/admin/user/'.$user->id, array('style'=>'float:left'));?> <form method="post"><input type="hidden" name="Delete[id]" value="<?php echo $user->id?>">
         
             <input type="image" src="/img_admin/delete.png" onclick="if(confirm('Удалить пользователя \'<?php echo $user->firstname?>\'?')){return true}else{return false} this.form.submit()"></form></td>
    </tr>
<?php } ?>
</table>
</div>
<?php
$this->widget('ext.widgets.MRPaginator.MRPaginator', array(
    'pages' => $pagination,
    'maxButtonCount' => Yii::app()->params['maxbuttonCount'],
    'header' => '',
    'cssFile' => $this->getAssetsUrl() . '/css/pagination_adm.css',
    'firstPageLabel' => '&laquo;',
    'lastPageLabel' => '&raquo;',
    'prevPageLabel'=>'Назад',
    'nextPageLabel'=>'Вперед',
))
?>   
                </td></tr></table>
