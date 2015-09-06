<?php

class m121206_171943_add_key_to_api_job extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	    $this->addForeignKey('ApiJob_ibfk_1', 'ApiJob', 'user_id', 'User', 'id','CASCADE', 'CASCADE');
	}

	public function safeDown()
	{
	    $this->dropForeignKey('ApiJob_ibfk_1', 'ApiJob');
	}

}