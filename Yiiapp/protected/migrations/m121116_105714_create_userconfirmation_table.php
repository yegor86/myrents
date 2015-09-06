<?php

class m121116_105714_create_userconfirmation_table extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('UserConfirmation', array(
  'user' =>"int(11) NOT NULL",
  'key' =>"varchar(50) NOT NULL",
  'date' =>"timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
  "PRIMARY KEY (`user`)",
  "KEY `key` (`key`)"

	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("UserConfirmation");
    }
}