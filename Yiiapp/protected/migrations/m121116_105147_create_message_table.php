<?php

class m121116_105147_create_message_table extends CDbMigration {

 
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('Message', array(
	    'id' => "int(11) NOT NULL AUTO_INCREMENT",
	    'sender_id' => "int(11) NOT NULL",
	    'receiver_id' => "int(11) NOT NULL",
	    'direction' => "enum('in','out') NOT NULL",
	    'date' => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
	    'readed' => "tinyint(1) NOT NULL DEFAULT '0'",
	    'message' => "text NOT NULL",
	    "PRIMARY KEY (`id`)",
	    "KEY `sender_id` (`sender_id`)",
	    "KEY `receiver_id` (`receiver_id`)",
	    "KEY `direction` (`direction`)",
	    "KEY `date` (`date`)",
	    "KEY `readed` (`readed`)",
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown() {
	$this->dropTable("Message");
    }

}