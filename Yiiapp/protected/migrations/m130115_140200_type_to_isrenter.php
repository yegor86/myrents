<?php

class m130115_140200_type_to_isrenter extends CDbMigration
{

	public function safeUp()
	{
	    $this->dropColumn('User', 'type');
	     $this->addColumn('User', 'is_renter', 'TINYINT DEFAULT 0');
	     $this->createIndex('is_renter', 'User', 'is_renter');
	}

	public function safeDown()
	{
	 $this->dropIndex('is_renter', 'User');
	 $this->dropColumn('User', 'is_renter') ;
	 $this->addColumn('User', 'type', "ENUM('private','realtor') DEFAULT 'private'");
	}

}