<?php

class m130922_155547_add_role_organizer_to_user_organizer extends CDbMigration
{
	
	private $_authManager;
	public function up()
	{
			$this->_authManager=Yii::app()->authManager;
			//rendeljük hozzá az organizer szerepkört a userhez, akinek az id=3
			$this->_authManager->assign('organizer',3);
	}

	public function down()
	{
		echo "m130922_155547_add_role_organizer_to_user_organizer does not support migration down.\n";
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