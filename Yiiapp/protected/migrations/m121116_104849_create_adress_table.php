<?php

class m121116_104849_create_adress_table extends CDbMigration {
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('Adress', array(
	    'id' => "int(20) NOT NULL DEFAULT '0'",
	    'name' => "varchar(250) NOT NULL DEFAULT 'Украина, Одесская область, Одесса'",
	    'geox' => "double NOT NULL DEFAULT '30.739846'",
	    'geoy' => "double NOT NULL DEFAULT '46.469517'",
	    'tree' => "int(11) NOT NULL DEFAULT '2'",
	    'rent_id' => "int(20) DEFAULT NULL",
	    'name_en' => "varchar(250) NOT NULL",
	    "PRIMARY KEY (`id`)",
	    "UNIQUE KEY `rent_id` (`rent_id`)",
	    "KEY `tree` (`tree`)",
	    "KEY `geox` (`geox`)",
	    "KEY `geoy` (`geoy`)",
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown() {
	$this->dropTable('Adress');
    }

}