<?php

class m121116_105005_create_currency_table extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('Currency', array(
  'id'=>" int(11) NOT NULL AUTO_INCREMENT",
  'full_name' =>"varchar(50) NOT NULL",
  'short_name' =>"char(4) NOT NULL",
  'symbol' =>"char(1) DEFAULT NULL",
  'rate'=>"float NOT NULL DEFAULT '1'",
  'image' =>"varchar(10) NOT NULL",
  "PRIMARY KEY (`id`)",
  "UNIQUE KEY `full_name` (`full_name`,`short_name`)"
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("Currency");
    }
}