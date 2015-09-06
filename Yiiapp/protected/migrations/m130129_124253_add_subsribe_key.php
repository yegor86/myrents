<?php

class m130129_124253_add_subsribe_key extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	    $this->addColumn('User', 'subscribed', 'TINYINT(1)  DEFAULT 0');
	    $this->createIndex('subscribed', 'User', 'subscribed');
	}

	public function safeDown()
	{
	    $this->dropColumn('User', 'subscribed');
	}

}