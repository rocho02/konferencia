<?php

class m131006_172217_tbl_message extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_message', array(
				'id_message' => 'pk',
				'id_sender' =>'int',
				'subject' => 'string',
				'body' =>'string',
				'flag' => 'int',
				'create_time' => 'datetime DEFAULT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	
		$this->createTable('tbl_user_message', array(
				'id_user_message' => 'pk',
				'id_recepient' => 'int',
				'id_message' => 'int',
				'status' => 'int',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		
	}

	public function down()
	{
		$this->dropTable('tbl_user_message');
		$this->dropTable('tbl_messagee');
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