<?php

class m121116_105250_create_operationlog_table extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('OperationLog', array(
  'id' =>"int(11) NOT NULL AUTO_INCREMENT",
  'user_id'=>"int(11) NOT NULL",
  'date' =>"timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
  'operation_id' =>"int(11) NOT NULL",
  'comment' =>"text NOT NULL",
  "PRIMARY KEY (`id`)",
  "KEY `operation` (`operation_id`)",
  "KEY `user_id` (`user_id`)",

	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("OperationLog");
    }
}