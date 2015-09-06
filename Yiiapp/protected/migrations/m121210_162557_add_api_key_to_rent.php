<?php

class m121210_162557_add_api_key_to_rent extends CDbMigration
{


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	    $this->addColumn('Rent', 'api_key', 'BIGINT');
	    $this->createIndex('api_key', 'Rent', 'api_key');
	}

	public function safeDown()
	{
	    $this->dropIndex('Rent', 'api_key');
	    $this->dropColumn('Rent', 'api_key');
	}
}