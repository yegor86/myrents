<?php

class m121127_133525_add_delete_key_to_rent extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	    $this->addColumn('Rent', 'is_deleted', 'TINYINT DEFAULT 0');
	    $this->createIndex('is_deleted', 'Rent', 'is_deleted');
	}

	public function safeDown()
	{
	    $this->dropIndex('is_deleted', 'Rent');
	    $this->dropColumn('Rent', 'is_deleted');
	}

}