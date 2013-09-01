<?php

class m130901_094322_insert_default_authorization_roles extends CDbMigration
{
	
	private $_authManager;
	
	public function up()
	{
			$this->_authManager=Yii::app()->authManager;
		
		 	//create the lowest level operations for users
			 $this->_authManager->createOperation("createUser",	"create a new user"); 
			 $this->_authManager->createOperation("readUser","read user profile information"); 
			 $this->_authManager->createOperation("updateUser",	"update a users in-formation"); 
			 $this->_authManager->createOperation("deleteUser",	"remove a user "); 
			 
			 
			 $role=$this->_authManager->createRole("admin");
			 
			 $role->addChild("createUser"); 
			 $role->addChild("updateUser"); 
			 $role->addChild("deleteUser"); 
			 $role->addChild("readUser"); 
			 
		
	}

	public function down()
	{
		$this->_authManager=Yii::app()->authManager;
		$this->_authManager->clearAll();
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