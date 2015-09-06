<?php

class m121116_105050_create_help_table extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('Help', array(
  'id'=>"int(11) NOT NULL AUTO_INCREMENT",
  'alias'=>"varchar(25) NOT NULL",
  "PRIMARY KEY (`id`)",
  "KEY `alias` (`alias`)"
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("Help");
    }
}