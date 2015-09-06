<?php

class m121206_125526_create_api_jobs_table extends CDbMigration
{
	public function safeUp()
	{
	    $this->createTable('ApiJob', array(
		'user_id'=>'BIGINT AUTO_INCREMENT',
		'status'=>"ENUM('deleted','error','new','queue','downloading','checking','forming','applying','image_procesing','completed') NOT NULL DEFAULT 'new'",
		'link'=>'VARCHAR(250)',
		'comments'=>'text',
		'PRIMARY KEY (`user_id`)',
		'KEY `status` (`status`)'
	    ));
	}

	public function safeDown()
	{
	    $this->dropTable('ApiJob');
	}
}