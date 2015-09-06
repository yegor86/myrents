<?php

class m121116_105134_create_maxupdatetime_table extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('MaxUpdateTime', array(
  'couter_id' =>"int(11) NOT NULL AUTO_INCREMENT",
  'max_update_time' =>"timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
  "PRIMARY KEY (`couter_id`)",
  "KEY `max_update_time` (`max_update_time`)"
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("MaxUpdateTime");
    }
}