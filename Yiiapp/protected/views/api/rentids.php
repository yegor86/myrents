<?php echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'?>
<?php echo '<advertisements>'?>
<?php foreach ($rents as $rent){
    echo "<id>$rent->id</id>";
}
?>
<?php echo '</advertisements>'?>