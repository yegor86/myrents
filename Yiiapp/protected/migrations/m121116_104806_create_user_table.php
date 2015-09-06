<?php

class m121116_104806_create_user_table extends CDbMigration
{

	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	    $this->createTable('User',array(
		'id'=>'int NOT NULL AUTO_INCREMENT',
		 'nick'=> 'varchar(250) NOT NULL',
		'email'=>'varchar(250) DEFAULT NULL',
		'password'=>'varchar(250) DEFAULT NULL',
		'role'=>'enum(\'banned\',\'reader\',\'writter\',\'moderator\',\'admin\') NOT NULL DEFAULT \'writter\'',
		'active'=>'int(11) NOT NULL DEFAULT \'0\'',
		'firstname'=>'varchar(250) DEFAULT NULL',
		'lastname'=>'varchar(250) DEFAULT ""',
		'phone'=>'tinytext',
		'login_fails'=>'int(11) NOT NULL DEFAULT \'0\'',
		'service'=>'varchar(50) NOT NULL DEFAULT \'local\'',
		'image'=>"varchar(50) NOT NULL DEFAULT 'noimage.jpg'",
		'member_since'=>"timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
		'last_worked'=>'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
		'skype'=>'varchar(50) NOT NULL',
		'overview'=>"text NOT NULL COMMENT 'описание'",
		'PRIMARY KEY (`id`)',
		
	    ),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	    $this->createIndex('nick', 'User', 'nick', true);
	    $this->createIndex('active', 'User', 'active');
	}

	public function safeDown()
	{
	    $this->dropTable("User");
	}
	
}