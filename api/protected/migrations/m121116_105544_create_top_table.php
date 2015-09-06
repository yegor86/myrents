<?php

class m121116_105544_create_top_table extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('Top', array(
  'rent_id' =>"int(11) NOT NULL",
  'start' =>"timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
  'end' =>"timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
  'action' =>"varchar(3) NOT NULL",
  "PRIMARY KEY (`rent_id`,`action`)",
  "KEY `start` (`start`,`end`)",
  "KEY `end` (`end`)",
  "KEY `action` (`action`)",
  "KEY `rent_id` (`rent_id`)",

	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("Top");
    }
}