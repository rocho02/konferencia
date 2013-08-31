<?php

class m130519_155432_create_user_table extends CDbMigration
{
	public function up()
	{
		//create the user table
		$this->createTable('tbl_user', array(
				'id' => 'pk',
				'username' => 'string NOT NULL',
				'email' => 'string NOT NULL',
				'password' => 'string NOT NULL',
				'last_login_time' => 'datetime DEFAULT NULL',
				'create_time' => 'datetime DEFAULT NULL',
				'create_user_id' => 'int(11) DEFAULT NULL',
				'update_time' => 'datetime DEFAULT NULL',
				'update_user_id' => 'int(11) DEFAULT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('tbl_user');
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