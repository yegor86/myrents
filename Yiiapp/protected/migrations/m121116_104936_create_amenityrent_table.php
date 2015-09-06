<?php

class m121116_104936_create_amenityrent_table extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('AmenityRent', array(
  'amenity'=>" int(11) NOT NULL",
  'rent' =>"int(11) NOT NULL",
  "PRIMARY KEY (`amenity`,`rent`)",
  "KEY `amenity` (`amenity`)",
  "KEY `rent` (`rent`)",

	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown() {
	$this->dropTable("AmenityRent");
    }
}