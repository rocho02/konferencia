<?php

class m131020_092025_create_event_admin extends CDbMigration
{
	private $_authManager;
	
	public function up()
	{
		$this->_authManager=Yii::app()->authManager;
		 $role= $this->_authManager->createRole("Event.Admin");
	}

	public function down()
	{
		echo "m131020_092025_create_event_admin does not support migration down.\n";
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