<?php

class m130831_162844_create_tbl_event extends CDbMigration
{
	public function up()
	{
		//create the user table
		$this->createTable('tbl_event', array(
				'id_event' => 'pk',
				'start_date' => 'datetime DEFAULT NULL',
				'end_date' => 'datetime DEFAULT NULL',
				'description' => 'string',
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