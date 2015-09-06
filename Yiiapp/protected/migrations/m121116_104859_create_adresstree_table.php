<?php

class m121116_104859_create_adresstree_table extends CDbMigration {

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('AdressTree', array(
	    'id' => "int(11) NOT NULL AUTO_INCREMENT",
	    'lft' => " int(11) NOT NULL",
	    'rgt' => "int(11) NOT NULL",
	    'level' => "int(11) NOT NULL",
	    'name' => "varchar(250) NOT NULL",
	    'geoX' => "double NOT NULL",
	    'geoY' => "double NOT NULL",
	    "PRIMARY KEY (`id`)",
	    "KEY `lft` (`lft`,`rgt`,`level`)"
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown() {
	$this->dropTable('AdressTree');
    }

}