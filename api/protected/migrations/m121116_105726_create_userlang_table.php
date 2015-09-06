<?php

class m121116_105726_create_userlang_table extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('UserLang', array(
  'user' =>"int(11) NOT NULL",
  'language' =>"int(11) NOT NULL",
  'value' =>"int(11) NOT NULL DEFAULT '5'",
  "PRIMARY KEY (`user`,`language`)",
  "KEY `language` (`language`)",
  "KEY `user` (`user`)"

	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("UserLang");
    }
}