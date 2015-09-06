<?php

class m121116_105447_create_seopage_table extends CDbMigration {


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('SeoPage', array(
	    'url' => "varchar(250) NOT NULL",
	    'lang' => "int(11) NOT NULL",
	    'title' => "text NOT NULL",
	    'keywords' => "text NOT NULL",
	    'description' => "text NOT NULL",
	    'h1' => "varchar(250) NOT NULL",
	    'content' => "text NOT NULL",
	    "PRIMARY KEY (`url`,`lang`)",
	    "KEY `lang` (`lang`)",
	    "KEY `url` (`url`)",
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown() {
	$this->dropTable("SeoPage");
    }

}