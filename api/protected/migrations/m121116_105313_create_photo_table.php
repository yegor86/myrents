<?php

class m121116_105313_create_photo_table extends CDbMigration {

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('Photo', array(
	    'id' => "int(11) NOT NULL AUTO_INCREMENT",
	    'rent' => "int(11) NOT NULL",
	    'name' => "varchar(250) NOT NULL",
	    'file' => "varchar(250) NOT NULL",
	    'cover' => "tinyint(1) NOT NULL",
	    "PRIMARY KEY (`id`)",
	    "KEY `rent` (`rent`)",
	    "KEY `cover` (`cover`)",
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown() {
	$this->dropTable("Photo");
    }

}