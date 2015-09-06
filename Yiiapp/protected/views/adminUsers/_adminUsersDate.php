<?php if(count($userlist)){ ?>
<table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort" id="sort_id">
    <th>ID</th><th>Аватар</th><th>Имя</th><th>Почта</th><th>Дата регистрации</th><th>Дата пос. активности</th><th>Функции</th>
<?php foreach($userlist as $user){ ?>
    <tr>
     <td align="center"><?php echo $user->id;?></td>
     <td align="center"><?php if (file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] .  "userpic/" . $user['image'])) {
                        echo '<a href="/user/'.$user->id.'"><span class="avatar_img_box" style="background-image:url(\'/uploads/userpic/little/'.$user['image'].'\'); background-position: center center; background-repeat:no-repeat;background-color:#fff;"></span></span></a>';
		    } else {
                        echo '<a href="/user/'.$user->id.'"><span class="avatar_img_box" style="background-image:url(\'/uploads/userpic/little/smaill_no-avatar.png\'); background-position: center center; background-repeat:no-repeat;background-color:#fff;"></span></span></a>';
		    }
		    ?></td>
     <td><a OnMouseOver="Tip('<div style=\'width: 500px;\' class=\'tiptip_box\'><b><?php echo $user->firstname.' '.$user->lastname;?></b><br><br><b>Контакты:</b><br>Skype: <?php echo $user->skype;?><br>Телефоны: <br><?php echo CustomFunctions::slashNtoBR($user->phone)?><br><br><b>Описание</b><br><?php echo $user->overview;?></div>')" href="/user/<?php echo $user->id;?>"><?php echo $user->firstname.' '.$user->lastname;?></a> <?php if($user->role=='admin') echo '(Администратор)'; elseif($user->role=='moderator') echo '(Модератор)';?></td>
     <td>
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
     
     <td align="center"><?php $reg_ex = explode(' ',$user->member_since); echo $reg_ex[0]?></td>
     <td align="center"><?php echo($user->last_worked);?></td>

     <td align="center"><?php echo CHtml::link('<img src="/img_admin/edit.png">', '/admin/user/'.$user->id);?> <form method="post"><input type="hidden" name="Delete[id]" value="<?php echo $user->id?>">
         
             <input type="image" src="/img_admin/delete.png" onclick="if(confirm('Удалить пользователя \'<?php echo $user->firstname?>\'?')){return true}else{return false} this.form.submit()"></form></td>
    </tr>
<?php } ?>
</table>
<?php }else{?>
<center><span class="not-found"></span></center>
<?php } ?>

                </td></tr></table>
