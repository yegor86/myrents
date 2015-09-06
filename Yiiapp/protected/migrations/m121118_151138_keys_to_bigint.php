<?php

class m121118_151138_keys_to_bigint extends CDbMigration
{
	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	  
	    // для изменения типов сначала нао будет поудалять связи, а потом их вернуть
	    $this->dropForeignKey('Rent_ibfk_1', "Rent");
	    $this->dropForeignKey('Adress_ibfk_1', "Adress");
	    $this->dropForeignKey('AmenityRent_ibfk_1', "AmenityRent");
	    $this->dropForeignKey('NeighborRent_ibfk_1', "NeighborRent");
	    $this->dropForeignKey('FavoritesRent_ibfk_1', "FavoritesRent");
	    $this->dropForeignKey('FavoritesRent_ibfk_2', "FavoritesRent");
	    $this->dropForeignKey('Message_ibfk_1', "Message");
	    $this->dropForeignKey('Message_ibfk_2', "Message");
	    $this->dropForeignKey('OperationLog_ibfk_3', "OperationLog");
	    $this->dropForeignKey('Photo_ibfk_1', "Photo");
	    $this->dropForeignKey('RentComment_ibfk_1', "RentComment");
	    $this->dropForeignKey('RentComment_ibfk_2', "RentComment");
	    $this->dropForeignKey('RentDescription_ibfk_3', "RentDescription");
	    $this->dropForeignKey('RentDescription_ibfk_5', "RentDescription");
	    $this->dropForeignKey('TempSMS_ibfk_1', "TempSMS");
	    $this->dropForeignKey('Top_ibfk_1', "Top");
	    $this->dropForeignKey('UserApiKey_ibfk_1', "UserApiKey");
	    $this->dropForeignKey('UserConfirmation_ibfk_1', "UserConfirmation");
	    $this->dropForeignKey('UserRemindPass_ibfk_1', "UserRemindPass");
	    $this->dropForeignKey('UserLang_ibfk_2', "UserLang");

	    //изменение типов полей
	    $this->alterColumn('Rent', 'user', 'BIGINT');
	    $this->alterColumn('Adress', 'rent_id', 'BIGINT');
	    $this->alterColumn('AmenityRent', 'rent', 'BIGINT');
	    $this->alterColumn('NeighborRent', 'rent', 'BIGINT');
	    $this->alterColumn('FavoritesRent', 'rent_id', 'BIGINT');
	    $this->alterColumn('FavoritesRent', 'user_id', 'BIGINT');
	    $this->alterColumn('Message', 'sender_id', 'BIGINT');
	    $this->alterColumn('Message', 'receiver_id', 'BIGINT');
	    $this->alterColumn('OperationLog', 'user_id', 'BIGINT');
	    $this->alterColumn('Photo', 'rent', 'BIGINT');
	    $this->alterColumn('RentComment', 'id', 'BIGINT NOT NULL AUTO_INCREMENT');
	    $this->alterColumn('RentComment', 'sender_id', 'BIGINT');
	    $this->alterColumn('RentComment', 'receiver_id', 'BIGINT');
	    $this->alterColumn('RentDescription', 'rent', 'BIGINT');
	    $this->alterColumn('TempSMS', 'sms_id', 'BIGINT');
	    $this->alterColumn('TempSMS', 'rent_id', 'BIGINT');
	    $this->alterColumn('Top', 'rent_id', 'BIGINT');
	    $this->alterColumn('UserApiKey', 'user_id', 'BIGINT');
	    $this->alterColumn('UserConfirmation', 'user', 'BIGINT');
	    $this->alterColumn('UserRemindPass', 'user_id', 'BIGINT');
	    $this->alterColumn('Rent', 'id', 'BIGINT NOT NULL AUTO_INCREMENT');
	    $this->alterColumn('Adress', 'id', 'BIGINT NOT NULL AUTO_INCREMENT');
	    $this->alterColumn('Message', 'id', 'BIGINT NOT NULL AUTO_INCREMENT');
	    $this->alterColumn('UserLang', 'user', 'BIGINT');
	    $this->alterColumn('Photo', 'id', 'BIGINT NOT NULL AUTO_INCREMENT');
	    $this->alterColumn('User', 'id', 'BIGINT NOT NULL AUTO_INCREMENT');
	    
	    //возвращение ключей
	    $this->addForeignKey('Rent_ibfk_1', "Rent", 'user', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Adress_ibfk_1', "Adress", 'rent_id', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('AmenityRent_ibfk_1', "AmenityRent", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('NeighborRent_ibfk_1', "NeighborRent", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('FavoritesRent_ibfk_1', "FavoritesRent", 'rent_id', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('FavoritesRent_ibfk_2', "FavoritesRent", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Message_ibfk_1', "Message", 'sender_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Message_ibfk_2', "Message", 'sender_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('OperationLog_ibfk_3', "OperationLog", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Photo_ibfk_1', "Photo", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('RentComment_ibfk_1', "RentComment", 'sender_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('RentComment_ibfk_2', "RentComment", 'receiver_id', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('RentDescription_ibfk_3', "RentDescription", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('RentDescription_ibfk_5', "RentDescription", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('TempSMS_ibfk_1', "TempSMS", 'rent_id', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Top_ibfk_1', "Top", 'rent_id', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('UserApiKey_ibfk_1', "UserApiKey", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('UserConfirmation_ibfk_1', "UserConfirmation", 'user', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('UserRemindPass_ibfk_1', "UserRemindPass", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('UserLang_ibfk_2', "UserLang", 'user', 'User', 'id', 'CASCADE', 'CASCADE');
	    
	    }

	    public function safeDown()
	{
	    $this->dropForeignKey('Rent_ibfk_1', "Rent");
	    $this->dropForeignKey('Adress_ibfk_1', "Adress");
	    $this->dropForeignKey('AmenityRent_ibfk_1', "AmenityRent");
	    $this->dropForeignKey('NeighborRent_ibfk_1', "NeighborRent");
	    $this->dropForeignKey('FavoritesRent_ibfk_1', "FavoritesRent");
	    $this->dropForeignKey('FavoritesRent_ibfk_2', "FavoritesRent");
	    $this->dropForeignKey('Message_ibfk_1', "Message");
	    $this->dropForeignKey('Message_ibfk_2', "Message");
	    $this->dropForeignKey('OperationLog_ibfk_3', "OperationLog");
	    $this->dropForeignKey('Photo_ibfk_1', "Photo");
	    $this->dropForeignKey('RentComment_ibfk_1', "RentComment");
	    $this->dropForeignKey('RentComment_ibfk_2', "RentComment");
	    $this->dropForeignKey('RentDescription_ibfk_3', "RentDescription");
	    $this->dropForeignKey('RentDescription_ibfk_5', "RentDescription");
	    $this->dropForeignKey('TempSMS_ibfk_1', "TempSMS");
	    $this->dropForeignKey('Top_ibfk_1', "Top");
	    $this->dropForeignKey('UserApiKey_ibfk_1', "UserApiKey");
	    $this->dropForeignKey('UserConfirmation_ibfk_1', "UserConfirmation");
	    $this->dropForeignKey('UserRemindPass_ibfk_1', "UserRemindPass");
	    $this->dropForeignKey('UserLang_ibfk_2', "UserLang");

	    //изменение типов полей
	    $this->alterColumn('Rent', 'user', 'INT');
	    $this->alterColumn('Adress', 'rent_id', 'INT');
	    $this->alterColumn('AmenityRent', 'rent', 'INT');
	    $this->alterColumn('NeighborRent', 'rent', 'INT');
	    $this->alterColumn('FavoritesRent', 'rent_id', 'INT');
	    $this->alterColumn('FavoritesRent', 'user_id', 'INT');
	    $this->alterColumn('Message', 'sender_id', 'INT');
	    $this->alterColumn('Message', 'receiver_id', 'INT');
	    $this->alterColumn('OperationLog', 'user_id', 'INT');
	    $this->alterColumn('Photo', 'rent', 'INT');
	    $this->alterColumn('RentComment', 'id', 'INT NOT NULL AUTO_INCREMENT');
	    $this->alterColumn('RentComment', 'sender_id', 'INT');
	    $this->alterColumn('RentComment', 'receiver_id', 'INT');
	    $this->alterColumn('RentDescription', 'rent', 'INT');
	    $this->alterColumn('TempSMS', 'sms_id', 'INT');
	    $this->alterColumn('TempSMS', 'rent_id', 'INT');
	    $this->alterColumn('Top', 'rent_id', 'INT');
	    $this->alterColumn('UserApiKey', 'user_id', 'INT');
	    $this->alterColumn('UserConfirmation', 'user', 'INT');
	    $this->alterColumn('UserRemindPass', 'user_id', 'INT');
	    $this->alterColumn('Rent', 'id', 'INT NOT NULL AUTO_INCREMENT');
	    $this->alterColumn('Adress', 'id', 'INT NOT NULL AUTO_INCREMENT');
	    $this->alterColumn('Message', 'id', 'INT NOT NULL AUTO_INCREMENT');
	    $this->alterColumn('UserLang', 'user', 'INT');
	    $this->alterColumn('Photo', 'id', 'INT NOT NULL AUTO_INCREMENT');
	    $this->alterColumn('User', 'id', 'INT NOT NULL AUTO_INCREMENT');
	    
	    //возвращение ключей
	    $this->addForeignKey('Rent_ibfk_1', "Rent", 'user', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Adress_ibfk_1', "Adress", 'rent_id', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('AmenityRent_ibfk_1', "AmenityRent", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('NeighborRent_ibfk_1', "NeighborRent", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('FavoritesRent_ibfk_1', "FavoritesRent", 'rent_id', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('FavoritesRent_ibfk_2', "FavoritesRent", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Message_ibfk_1', "Message", 'sender_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Message_ibfk_2', "Message", 'sender_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('OperationLog_ibfk_3', "OperationLog", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Photo_ibfk_1', "Photo", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('RentComment_ibfk_1', "RentComment", 'sender_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('RentComment_ibfk_2', "RentComment", 'receiver_id', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('RentDescription_ibfk_3', "RentDescription", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('RentDescription_ibfk_5', "RentDescription", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('TempSMS_ibfk_1', "TempSMS", 'rent_id', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Top_ibfk_1', "Top", 'rent_id', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('UserApiKey_ibfk_1', "UserApiKey", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('UserConfirmation_ibfk_1', "UserConfirmation", 'user', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('UserRemindPass_ibfk_1', "UserRemindPass", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('UserLang_ibfk_2', "UserLang", 'user', 'User', 'id', 'CASCADE', 'CASCADE');
	}
	
}