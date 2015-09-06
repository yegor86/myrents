<?php

class m121116_105436_create_rentdescription_table extends CDbMigration
{

     // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('RentDescription', array(
  'language' =>"int(11) NOT NULL DEFAULT '1'",
  'rent' =>"int(11) NOT NULL DEFAULT '0'",
  'name' =>"varchar(135) NOT NULL DEFAULT ' '",
  'overview' =>"text NOT NULL",
  'rules' =>"text NOT NULL",
  "PRIMARY KEY (`language`,`rent`)",
  "KEY `language` (`language`)",
  "KEY `rent` (`rent`)",

	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("RentDescription");
    }
}