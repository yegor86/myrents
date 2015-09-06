<?php

class m121116_105803_create_full_adress_view extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->execute("
	    CREATE  VIEW `full_address` AS select `t`.`id` AS `id`,`t`.`lft` AS `lft`,`t`.`rgt` AS `rgt`,`t`.`level` AS `level`,`t`.`name` AS `name`,`t`.`name_en` AS `name_en`,`t`.`geoX` AS `geoX`,`t`.`geoY` AS `geoY`,(select group_concat(`address_tree`.`name` order by `address_tree`.`level` ASC separator ', ') from `address_tree` where ((`address_tree`.`lft` <= (select `address_tree`.`lft` from `address_tree` where (`address_tree`.`id` = `t`.`id`))) and (`address_tree`.`rgt` >= (select `address_tree`.`rgt` from `address_tree` where (`address_tree`.`id` = `t`.`id`))))) AS `fullname`,(select group_concat(`address_tree`.`name_en` order by `address_tree`.`level` ASC separator ', ') from `address_tree` where ((`address_tree`.`lft` <= (select `address_tree`.`lft` from `address_tree` where (`address_tree`.`id` = `t`.`id`))) and (`address_tree`.`rgt` >= (select `address_tree`.`rgt` from `address_tree` where (`address_tree`.`id` = `t`.`id`))))) AS `fullname_en` from `address_tree` `t` order by `t`.`id` 
");
    }
    public function safeDown() {
	$this->execute("DROP VIEW `full_address`");
    }
}