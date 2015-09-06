<?php

class m121116_105303_create_partner_table extends CDbMigration {

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('Partner', array(
	    'id' => "int(11) NOT NULL AUTO_INCREMENT",
	    'image' => "varchar(250) NOT NULL",
	    'url' => "varchar(250) NOT NULL",
	    'ord' => "int(11) NOT NULL",
	    "PRIMARY KEY (`id`)",
	    "KEY `ord` (`ord`)"
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown() {
	$this->dropTable("Partner");
    }

}