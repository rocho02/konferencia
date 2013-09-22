<?php

class m130922_151830_role_management_changes extends CDbMigration
{
	private $_authManager;
	public function up()
	{
		$this->_authManager=Yii::app()->authManager;
		
				$this->insert('tbl_user', array(
				'ID'=> '3',
				'username' => 'organizer',
				'email' => 'organizer@yii.com',
				'password' => '098f6bcd4621d373cade4e832627b4f6',
				'last_login_time' => 'NULL',
				'create_time' => '2013-08-30 12:00',
				'create_user_id' => '1',
				'update_time' => 'NULL',
				'update_user_id' => 'NULL',
		)
	); 
	$this->_authManager->createOperation("Event.Create", "create event");
	$role=$this->_authManager->getAuthItem("admin");
	
			 $role->addChild("Event.Create"); 
			 $role->addChild("Event.Update"); 
			 $role->addChild("Event.Delete"); 
			 $role->addChild("Event.Read"); 
	}

	public function down()
	{
		echo "m130922_151830_role_management_changes does not support migration down.\n";
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