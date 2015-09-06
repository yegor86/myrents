<?php

class m121116_105040_create_favoritesrent_table extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('FavoritesRent', array(
  'rent_id' =>"int(11) NOT NULL",
  'user_id' =>"int(11) NOT NULL",
  "PRIMARY KEY (`rent_id`,`user_id`)",
  "KEY `user_id` (`user_id`)",
  "KEY `rent_id` (`rent_id`)",

	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("FavoritesRent");
    }
}