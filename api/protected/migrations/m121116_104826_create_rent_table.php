<?php

class m121116_104826_create_rent_table extends CDbMigration {

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp() {
	$this->createTable('Rent', array(
	    'id' => " int NOT NULL DEFAULT '0'",
	    'user' => "int(20) DEFAULT NULL",
	    'ratio' => "float NOT NULL DEFAULT '0'",
	    'type' => "int(11) NOT NULL DEFAULT '1'",
	    'todo' => " int(11) NOT NULL DEFAULT '1'",
	    'price_day' => "float NOT NULL DEFAULT '0'",
	    'price_week' => "float NOT NULL DEFAULT '0'",
	    'price_month' => "float NOT NULL DEFAULT '0'",
	    'index_price_day' => "int(11) NOT NULL",
	    'index_price_week' => "int(11) NOT NULL",
	    'index_price_month' => "int(11) NOT NULL",
	    'current_price' => "enum('1','2','3') NOT NULL DEFAULT '1'",
	    'currency_id' => "int(11) NOT NULL DEFAULT '1'",
	    'floor' => "int(11) NOT NULL DEFAULT '1'",
	    'in_show' => "tinyint(1) NOT NULL DEFAULT '1'",
	    'rooms_count' => "int(11) NOT NULL DEFAULT '1'",
	    'square' => "float NOT NULL DEFAULT '0'",
	    'amenity_bitmask' => "int(11) NOT NULL",
	    'neiborhood_bitmask' => "int(11) NOT NULL",
	    'creation_date' => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
	    'last_up' => "timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
	    'show_in_main' => "tinyint(1) NOT NULL DEFAULT '0'",
	    'last_modify' => "timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
	    "PRIMARY KEY (`id`)",
	    "KEY `user` (`user`)",
	    "KEY `type` (`type`)",
	    "KEY `todo` (`todo`)",
	    "KEY `price_month` (`price_month`)",
	    "KEY `price_week` (`price_week`)",
	    "KEY `price_day` (`price_day`)",
	    "KEY `in_show` (`in_show`)",
	    "KEY `rooms_count` (`rooms_count`)",
	    "KEY `square` (`square`)",
	    "KEY `floor` (`floor`)",
	    "KEY `current_price` (`current_price`)",
	    "KEY `ratio` (`ratio`)",
	    "KEY `amenity_bitmask` (`amenity_bitmask`)",
	    "KEY `neiborhood_bitmask` (`neiborhood_bitmask`)",
	    "KEY `creation_date` (`creation_date`)",
	    "KEY `last_up` (`last_up`)",
	    "KEY `currency_id` (`currency_id`)",
	    "KEY `show_in_main` (`show_in_main`)",
	    "KEY `index_price_day` (`index_price_day`)",
	    "KEY `index_price_week` (`index_price_week`)",
	    "KEY `index_price_month` (`index_price_month`)",
	    "KEY `last_modify` (`last_modify`)",
	),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown() {
	$this->dropTable('Rent');
    }

}