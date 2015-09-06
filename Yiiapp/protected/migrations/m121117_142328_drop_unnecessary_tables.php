<?php

class m121117_142328_drop_unnecessary_tables extends CDbMigration {
    /*
     * ап, поскольку у нас нет отката для safeDown , пишем транзакцию вручную
     */

    public function safeUp() {
	$this->dropColumn('Adress', 'tree');
	$this->dropTable('AdressTree');
	$this->insert('DBVariables', array('name' => 'max_update_time', 'value' => date('Y-m-d H:i:s')));
	$this->dropTable('MaxUpdateTime');
	$this->dropForeignKey('PrimaryAccount_ibfk_1', "PrimaryAccount");
	$this->dropTable('PrimaryAccount');
	$this->dropTable('StartPageTop');
	$this->dropTable('post');
    }

    public function safeDown() {
	$this->createTable('AdressTree', array(
	    'id' => "int(11) NOT NULL AUTO_INCREMENT",
	    'lft' => " int(11) NOT NULL",
	    'rgt' => "int(11) NOT NULL",
	    'level' => "int(11) NOT NULL",
	    'name' => "varchar(250) NOT NULL",
	    'geoX' => "double NOT NULL",
	    'geoY' => "double NOT NULL",
	    "PRIMARY KEY (`id`)",
	    "KEY `lft` (`lft`,`rgt`,`level`)"
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	$this->createTable('MaxUpdateTime', array(
	    'couter_id' => "int(11) NOT NULL AUTO_INCREMENT",
	    'max_update_time' => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
	    "PRIMARY KEY (`couter_id`)",
	    "KEY `max_update_time` (`max_update_time`)"
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	$this->createTable('PrimaryAccount', array(
	    'user_id' => "int(11) NOT NULL",
	    'level' => "int(11) NOT NULL",
	    'expiration_date' => "date NOT NULL",
	    "PRIMARY KEY (`user_id`)",
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	$this->addForeignKey('PrimaryAccount_ibfk_1', "PrimaryAccount", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');
	$this->createTable('StartPageTop', array(
	    'rent_id' => "int(11) NOT NULL",
	    'start' => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
	    'end' => "timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
	    "PRIMARY KEY (`rent_id`)",
	    "KEY `start` (`start`,`end`)",
	    "KEY `end` (`end`)"
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	$this->createTable('post', array(
	    'id' => "int(11) NOT NULL AUTO_INCREMENT",
	    'created_on' => "int(11) NOT NULL",
	    'title' => "varchar(255) NOT NULL",
	    'context' => "text NOT NULL",
	    "PRIMARY KEY (`id`)"
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	$this->addColumn('Adress', 'tree', 'int');
    }

}