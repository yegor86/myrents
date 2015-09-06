<?php

class m121116_105737_create_userremindpass_table extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('UserRemindPass', array(
  'user_id' =>"int(11) NOT NULL",
  'key' =>"varchar(50) NOT NULL",
  'date' =>"timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
  "PRIMARY KEY (`user_id`,`key`)",
  "UNIQUE KEY `user_id` (`user_id`)"

	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("UserRemindPass");
    }
}