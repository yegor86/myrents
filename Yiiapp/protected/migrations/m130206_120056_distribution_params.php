<?php

class m130206_120056_distribution_params extends CDbMigration
{
	public function safeUp()
	{
	    $this->insert('DBVariables', array(
		'name'=>'DJobStatus',
		'value'=>'disabled'));
	    $this->insert('DBVariables', array(
		'name'=>'DJobProgress',
		'value'=>'0\0'
	    ));
	}
	public function safeDown()
	{
		$this->delete('DBVariables', 'name = "DJobStatus"');
		$this->delete('DBVariables', 'name = "DJobProgress"');
	}
}