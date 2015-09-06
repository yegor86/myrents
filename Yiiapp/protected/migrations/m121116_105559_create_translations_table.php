<?php

class m121116_105559_create_translations_table extends CDbMigration
{

 
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('Translations', array(
  'row_id' =>"int(11) NOT NULL",
  'lang_id' =>"int(11) NOT NULL",
  'table_key' =>"enum('Partner','StaticPage','Help','') NOT NULL",
  'description' =>"text NOT NULL",
  'name' =>"varchar(250) NOT NULL",
  "PRIMARY KEY (`row_id`,`lang_id`,`table_key`)",
  "KEY `row_id` (`row_id`)",
  "KEY `lang_id` (`lang_id`)",
  "KEY `table_key` (`table_key`)",

	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("Translations");
    }
}