<?php

class m121116_105018_create_dbvariables_table extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('DBVariables', array(
  'name'=>"varchar(20) NOT NULL",
  'value'=>"varchar(50) NOT NULL",
  "PRIMARY KEY (`name`)"
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("DBVariables");
    }
}