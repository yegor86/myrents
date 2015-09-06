<?php

class m121116_105247_create_operation_table extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('Operation', array(
  'id'=>"int(11) NOT NULL AUTO_INCREMENT",
  'name'=>"varchar(50) NOT NULL",
  "PRIMARY KEY (`id`)",
  "UNIQUE KEY `name` (`name`)"
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("Operation");
    }
}