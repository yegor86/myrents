<?php

class m121116_105106_create_language_table extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('Language', array(
  'id'=>"int(11) NOT NULL AUTO_INCREMENT",
  'language' =>"varchar(5) NOT NULL",
  'name' =>"varchar(20) NOT NULL",
  "PRIMARY KEY (`id`)"
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("Language");
    }
}