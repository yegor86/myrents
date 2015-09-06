<?php

class m121228_141208_add_started_status_to_apijob extends CDbMigration
{

	public function safeUp()
	{
	     $this->dropForeignKey('ApiJob_ibfk_1', 'ApiJob');
	    $this->alterColumn('ApiJob', 'status', "enum('deleted','error','new','queue','started','downloading','checking','forming','applying','image_procesing','completed') NOT NULL DEFAULT 'new'");
	    $this->addForeignKey('ApiJob_ibfk_1', 'ApiJob', 'user_id', 'User', 'id','CASCADE', 'CASCADE');
	}

	public function safeDown()
	{
	    $this->dropForeignKey('ApiJob_ibfk_1', 'ApiJob');
	    $this->alterColumn('ApiJob', 'status', "enum('deleted','error','new','queue','downloading','checking','forming','applying','image_procesing','completed') NOT NULL DEFAULT 'new'");
	    $this->addForeignKey('ApiJob_ibfk_1', 'ApiJob', 'user_id', 'User', 'id','CASCADE', 'CASCADE');
	}

}