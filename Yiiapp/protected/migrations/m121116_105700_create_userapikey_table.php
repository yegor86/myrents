<?php

class m121116_105700_create_userapikey_table extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('UserApiKey', array(
  'user_id' =>"int(11) NOT NULL",
  'key' =>"varchar(50) NOT NULL",
  "PRIMARY KEY (`user_id`)",
  "KEY `key` (`key`)",

	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("UserApiKey");
    }
}