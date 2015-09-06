<?php

class m121116_105423_create_rentcomment_table extends CDbMigration {


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('RentComment', array(
	    'id' => "int(11) NOT NULL AUTO_INCREMENT",
	    'sender_id' => "int(11) NOT NULL",
	    'receiver_id' => "int(11) NOT NULL",
	    'date' => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
	    'message' => "text NOT NULL",
	    'in_show' => "tinyint(1) NOT NULL DEFAULT '1'",
	    "PRIMARY KEY (`id`)",
	    "KEY `sender_id` (`sender_id`,`receiver_id`,`in_show`)",
	    "KEY `receiver_id` (`receiver_id`)",
	    "KEY `in_show` (`in_show`)",
	    "KEY `date` (`date`)",
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown() {
	$this->dropTable("RentComment");
    }

}