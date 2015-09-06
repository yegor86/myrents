<?php

class m121116_105329_create_primaryaccount_table extends CDbMigration {


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('PrimaryAccount', array(
	    'user_id' => "int(11) NOT NULL",
	    'level' => "int(11) NOT NULL",
	    'expiration_date' => "date NOT NULL",
	    "PRIMARY KEY (`user_id`)",
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown() {
	$this->dropTable("PrimaryAccount");
    }

}