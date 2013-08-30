<?php

class m130830_183559_insert_add_default_user extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_user', array(
				'ID'=> '1',
				'username' => 'admin',
				'email' => 'admin@yii.com',
				'password' => '098f6bcd4621d373cade4e832627b4f6',
				'last_login_time' => 'NULL',
				'create_time' => '2013-08-30 12:00',
				'create_user_id' => '1',
				'update_time' => 'NULL',
				'update_user_id' => 'NULL',
		)
	);
	}

	public function down()
	{
			$this->delete('tbl_user', 'id=:id',array(':id'=>1) );	
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