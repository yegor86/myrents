<?php

class m121116_105206_create_neighbor_table extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('Neighbor', array(
  'id'=>" int(11) NOT NULL AUTO_INCREMENT",
  'name'=>"varchar(250) NOT NULL",
  "PRIMARY KEY (`id`)"
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("Neighbor");
    }
}