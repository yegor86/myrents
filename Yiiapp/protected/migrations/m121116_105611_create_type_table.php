<?php

class m121116_105611_create_type_table extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('Type', array(
  'id' =>"int(11) NOT NULL AUTO_INCREMENT",
  'name' =>"varchar(250) NOT NULL",
  "PRIMARY KEY (`id`)"

	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("Type");
    }
}