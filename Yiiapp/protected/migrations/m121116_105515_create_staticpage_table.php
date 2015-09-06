<?php

class m121116_105515_create_staticpage_table extends CDbMigration {
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('StaticPage', array(
	    'id' => "int(11) NOT NULL AUTO_INCREMENT",
	    'alias' => "varchar(250) NOT NULL",
	    "PRIMARY KEY (`id`)",
	    "KEY `alias` (`alias`)"
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown() {
	$this->dropTable("StaticPage");
    }

}