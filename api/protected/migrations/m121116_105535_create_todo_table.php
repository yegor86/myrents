<?php

class m121116_105535_create_todo_table extends CDbMigration {
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('Todo', array(
	    'id' => "int(11) NOT NULL AUTO_INCREMENT",
	    'name' => "varchar(50) NOT NULL",
	    "PRIMARY KEY (`id`)"
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown() {
	$this->dropTable("Todo");
    }

}