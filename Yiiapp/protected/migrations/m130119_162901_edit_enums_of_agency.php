<?php

class m130119_162901_edit_enums_of_agency extends CDbMigration
{
	public function safeUp()
	{
	    $this->alterColumn('Agency', 'status', "ENUM('deleted','closed','new','active','confirmed') DEFAULT 'new'");
	}

	public function safeDown()
	{
	    $this->alterColumn('Agency', 'status', "ENUM('active','inactive','closed','deleted')");
	}
}