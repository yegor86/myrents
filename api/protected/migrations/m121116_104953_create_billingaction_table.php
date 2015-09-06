<?php

class m121116_104953_create_billingaction_table extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('BillingAction', array(
'name'=>" varchar(3) NOT NULL",
  "PRIMARY KEY (`name`)"
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("BillingAction");
    }
}