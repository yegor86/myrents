<?php

class m121116_105835_create_post_table extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('post', array(
  'id' =>"int(11) NOT NULL AUTO_INCREMENT",
  'created_on' =>"int(11) NOT NULL",
  'title' =>"varchar(255) NOT NULL",
  'context' =>"text NOT NULL",
  "PRIMARY KEY (`id`)"
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }
    public function safeDown() {
	$this->dropTable("post");
    }
}