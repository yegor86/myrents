<?php

class m121116_105501_create_startpagetop_table extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('StartPageTop', array(
  'rent_id' =>"int(11) NOT NULL",
  'start' =>"timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
  'end' =>"timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
  "PRIMARY KEY (`rent_id`)",
  "KEY `start` (`start`,`end`)",
  "KEY `end` (`end`)"

	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("StartPageTop");
    }
}