<?php

class m130122_153425_add_usertype_column_to_user extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{	    $this->addColumn('User', 'rentertype', 'ENUM("user","renter","agency") DEFAULT "user"');
	    $this->createIndex("rentertype", 'User', 'rentertype');
	}

	public function safeDown()
	{
	  		$this->dropColumn('User', 'rentertype');
	}
	
}