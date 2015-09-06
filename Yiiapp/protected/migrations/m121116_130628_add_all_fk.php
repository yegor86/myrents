<?php

class m121116_130628_add_all_fk extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	    $this->addForeignKey('Rent_ibfk_1', "Rent", 'user', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Rent_ibfk_2', "Rent", 'type', 'Type', 'id', 'NO ACTION', 'NO ACTION');
	    $this->addForeignKey('Rent_ibfk_3', "Rent", 'todo', 'Todo', 'id', 'NO ACTION', 'NO ACTION');
	    $this->addForeignKey('Rent_ibfk_4', "Rent", 'currency_id', 'Currency', 'id', 'NO ACTION', 'NO ACTION');
	    $this->addForeignKey('Adress_ibfk_1', "Adress", 'rent_id', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('AmenityRent_ibfk_1', "AmenityRent", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');	    
	    $this->addForeignKey('AmenityRent_ibfk_2', "AmenityRent", 'amenity', 'Amenity', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('FavoritesRent_ibfk_1', "FavoritesRent", 'rent_id', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('FavoritesRent_ibfk_2', "FavoritesRent", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');	    
	    $this->addForeignKey('Message_ibfk_1', "Message", 'sender_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Message_ibfk_2', "Message", 'sender_id', 'User', 'id', 'CASCADE', 'CASCADE');	    
	    $this->addForeignKey('NeighborRent_ibfk_1', "NeighborRent", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('NeighborRent_ibfk_2', "NeighborRent", 'neighbor', 'Neighbor', 'id', 'CASCADE', 'CASCADE');	    
	    $this->addForeignKey('OperationLog_ibfk_2', "OperationLog", 'operation_id', 'Operation', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('OperationLog_ibfk_3', "OperationLog", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Photo_ibfk_1', "Photo", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('PrimaryAccount_ibfk_1', "PrimaryAccount", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('RentComment_ibfk_1', "RentComment", 'sender_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('RentComment_ibfk_2', "RentComment", 'receiver_id', 'Rent', 'id', 'CASCADE', 'CASCADE');	    
	    $this->addForeignKey('RentDescription_ibfk_1', "RentDescription", 'language', 'Language', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('RentDescription_ibfk_3', "RentDescription", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('RentDescription_ibfk_4', "RentDescription", 'language', 'Language', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('RentDescription_ibfk_5', "RentDescription", 'rent', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('SeoPage_ibfk_1', "SeoPage", 'lang', 'Language', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('TempSMS_ibfk_1', "TempSMS", 'rent_id', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Top_ibfk_1', "Top", 'rent_id', 'Rent', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Top_ibfk_2', "Top", 'action', 'BillingAction', 'name', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('Translations_ibfk_1', "Translations", 'lang_id', 'Language', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('UserApiKey_ibfk_1', "UserApiKey", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('UserConfirmation_ibfk_1', "UserConfirmation", 'user', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('UserRemindPass_ibfk_1', "UserRemindPass", 'user_id', 'User', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('UserLang_ibfk_1', "UserLang", 'language', 'Language', 'id', 'CASCADE', 'CASCADE');
	    $this->addForeignKey('UserLang_ibfk_2', "UserLang", 'user', 'User', 'id', 'CASCADE', 'CASCADE');
	}

	public function safeDown()
	{
	    $this->dropForeignKey('Rent_ibfk_1', "Rent");
	    $this->dropForeignKey('Rent_ibfk_2', "Rent");
	    $this->dropForeignKey('Rent_ibfk_3', "Rent");
    	    $this->dropForeignKey('Rent_ibfk_4', "Rent");
	    $this->dropForeignKey('Adress_ibfk_1', "Adress");
	    $this->dropForeignKey('AmenityRent_ibfk_1', "AmenityRent");
	    $this->dropForeignKey('AmenityRent_ibfk_2', "AmenityRent");
	    $this->dropForeignKey('FavoritesRent_ibfk_1', "FavoritesRent");
	    $this->dropForeignKey('FavoritesRent_ibfk_2', "FavoritesRent");
	    $this->dropForeignKey('Message_ibfk_1', "Message");
	    $this->dropForeignKey('Message_ibfk_2', "Message");
	    $this->dropForeignKey('NeighborRent_ibfk_1', "NeighborRent");
	    $this->dropForeignKey('NeighborRent_ibfk_2', "NeighborRent");
	    $this->dropForeignKey('OperationLog_ibfk_2', "OperationLog");
	    $this->dropForeignKey('OperationLog_ibfk_3', "OperationLog");
	    $this->dropForeignKey('Photo_ibfk_1', "Photo");
	    $this->dropForeignKey('PrimaryAccount_ibfk_1', "PrimaryAccount");
	    $this->dropForeignKey('RentComment_ibfk_1', "RentComment");
	    $this->dropForeignKey('RentComment_ibfk_2', "RentComment");
	    $this->dropForeignKey('RentDescription_ibfk_1', "RentDescription");
	    $this->dropForeignKey('RentDescription_ibfk_3', "RentDescription");
	    $this->dropForeignKey('RentDescription_ibfk_4', "RentDescription");
	    $this->dropForeignKey('RentDescription_ibfk_5', "RentDescription");
	    $this->dropForeignKey('SeoPage_ibfk_1', "SeoPage");
	    $this->dropForeignKey('TempSMS_ibfk_1', "TempSMS");
	    $this->dropForeignKey('Top_ibfk_1', "Top");
	    $this->dropForeignKey('Top_ibfk_2', "Top");
	    $this->dropForeignKey('Translations_ibfk_1', "Translations");
	    $this->dropForeignKey('UserApiKey_ibfk_1', "UserApiKey");
	    $this->dropForeignKey('UserConfirmation_ibfk_1', "UserConfirmation");
	    $this->dropForeignKey('UserRemindPass_ibfk_1', "UserRemindPass");
	    $this->dropForeignKey('UserLang_ibfk_1', "UserLang");
	    $this->dropForeignKey('UserLang_ibfk_2', "UserLang");
	    
	}
	
}