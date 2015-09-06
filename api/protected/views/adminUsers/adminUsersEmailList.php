
<table border="0" width="100%" width="100%" cellpadding="0" cellspacing="0"><tr><td width="20%" valign="top" class="left_container">
<?php require 'leftmenu.php';?>
        </td><td width="80%" class="right_container">
           
            <h2>Список почты</h2>
<?php foreach($userEmailList as $email){ ?>


<?php
         if($email->email) echo $email->email.'<br/>';?>

     
     

<?php } ?>
</table>

            
                </td></tr></table>
