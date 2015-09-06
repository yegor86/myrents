<?php

class m121116_105235_create_neifhborrent_table extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('NeighborRent', array(
  "neighbor"=>"int(11) NOT NULL",
  "rent"=>"int(11) NOT NULL",
  "PRIMARY KEY (`neighbor`,`rent`)",
  "KEY `neighbor` (`neighbor`)",
  "KEY `rent` (`rent`)",
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("NeighborRent");
    }
}