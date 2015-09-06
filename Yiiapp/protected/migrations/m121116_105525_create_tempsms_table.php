<?php

class m121116_105525_create_tempsms_table extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('TempSMS', array(
  'sms_id' =>"int(11) NOT NULL",
  'rent_id' =>"int(11) NOT NULL",
  'action' =>"varchar(10) NOT NULL",
  'number' =>"varchar(20) NOT NULL",
  'date' =>"timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
  "PRIMARY KEY (`sms_id`)",
  "KEY `rent_id` (`rent_id`)",

	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("TempSMS");
    }
}