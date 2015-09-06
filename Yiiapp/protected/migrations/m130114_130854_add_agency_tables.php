<?php

class m130114_130854_add_agency_tables extends CDbMigration {

    public function safeUp() {
	$this->addColumn('User', 'type', "ENUM('private','realtor') DEFAULT 'private'");
	$this->createTable('Agency', array(
	    'id' => 'int(11) NOT NULL AUTO_INCREMENT',
	    'status' => "ENUM('active','inactive','closed','deleted')",
	    'image' => 'VARCHAR(250)',
	    'PRIMARY KEY (`id`)',
	    "KEY `status` (`status`)",
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	$this->createTable('AgencyDescription', array(
	    'language_id' => "int(11) NOT NULL DEFAULT '1'",
	    'agency_id' => "int(11) NOT NULL DEFAULT '0'",
	    'name' => "varchar(135) NOT NULL DEFAULT ' '",
	    'description' => "text NOT NULL",
	    "PRIMARY KEY (`language_id`,`agency_id`)",
	    "KEY `language_id` (`language_id`)",
	    "KEY `agency_id` (`agency_id`)",
	    
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	$this->createTable('AgencyUser', array(
	    'agency_id' => "int(11) NOT NULL DEFAULT '1'",
	    'user_id' => "BIGINT NOT NULL DEFAULT '0'",
	    'status' => "ENUM('banned','waiting','member','admin','creator') NOT NULL DEFAULT 'waiting'",
	    "PRIMARY KEY (`agency_id`,`user_id`)",
	    "KEY `agency_id` (`agency_id`)",
	    "KEY `user_id` (`user_id`)",
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');


	$this->addForeignKey('AgencyDescription_ibfk_1', "AgencyDescription", 'language_id', 'Language', 'id', 'CASCADE', 'CASCADE');
	$this->addForeignKey('AgencyDescription_ibfk_2', "AgencyDescription", 'agency_id', 'Agency', 'id', 'CASCADE', 'CASCADE');
	$this->addForeignKey('AgencyUser_ibfk_1', "AgencyUser", 'agency_id', 'Agency', 'id', 'CASCADE', 'CASCADE');
	$this->addForeignKey('AgencyUser_ibfk_2', "AgencyUser", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown() {
	 $this->dropForeignKey('AgencyUser_ibfk_2', "AgencyUser");
	    $this->dropForeignKey('AgencyUser_ibfk_1', "AgencyUser");
	    $this->dropForeignKey('AgencyDescription_ibfk_2', "AgencyDescription");
	    $this->dropForeignKey('AgencyDescription_ibfk_1', "AgencyDescription");
	    $this->dropTable('AgencyUser');
	    $this->dropTable('AgencyDescription');
	    $this->dropTable('Agency');
	    $this->dropColumn('User', 'type');
	
	
    }

}