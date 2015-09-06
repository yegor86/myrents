<?php

class m121116_105816_create_indexbase_view extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->execute("
	    CREATE VIEW `indexbase` AS select `Rent`.`id` AS `id`,`Rent`.`last_modify` AS `last_modify`,`Adress`.`name` AS `adress`,`Adress`.`name_en` AS `adress_en`,group_concat(`RentDescription`.`name` separator ' , ') AS `name` from ((`Rent` join `RentDescription` on((`RentDescription`.`rent` = `Rent`.`id`))) join `Adress` on((`Adress`.`rent_id` = `Rent`.`id`))) group by `Rent`.`id` 
");
    }
    public function safeDown() {
	$this->execute("DROP VIEW `indexbase`");
    }
}