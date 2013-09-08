<?php

class m130901_173315_create_tbl_topic extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_topic', array(
				'id_topic' => 'pk',
				'name_topic' => 'string NOT NULL',
				'description' => 'string',
				'create_time' => 'datetime DEFAULT NULL',
				'create_user_id' => 'int(11) DEFAULT NULL',
				'update_time' => 'datetime DEFAULT NULL',
				'update_user_id' => 'int(11) DEFAULT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('tbl_topic');
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