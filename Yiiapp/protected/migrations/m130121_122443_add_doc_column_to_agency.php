<?php

class m130121_122443_add_doc_column_to_agency extends CDbMigration
{

	public function safeUp()
	{
	    	    $this->addColumn('Agency', 'doc', 'varchar(250)');
	}

	public function safeDown()
	{
	     $this->dropColumn('Agency', 'doc');
	}

}