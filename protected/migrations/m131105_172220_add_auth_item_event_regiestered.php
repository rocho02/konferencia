<?php

class m131105_172220_add_auth_item_event_regiestered extends CDbMigration
{
	public function up(){
	    $authManager=Yii::app()->authManager;
        $role= $authManager->createRole("Event.Registered");
	}

	public function down()
	{
		echo "m131105_172220_add_auth_item_event_regiestered does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}