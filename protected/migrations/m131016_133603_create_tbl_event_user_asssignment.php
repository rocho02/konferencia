<?php

class m131016_133603_create_tbl_event_user_asssignment extends CDbMigration
{
	public function up()
	{
		
		$this->createTable('tbl_user_event_assignment', array(
				'id_user' => 'int',
				'id_event' => 'int',
				'role' => 'string',
				'PRIMARY KEY (`id_event`,`id_user`)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		
		$this->addForeignKey("fk_event_user", "tbl_user_event_assignment", "id_event", "tbl_event", "id_event", "CASCADE", "RESTRICT");
		$this->addForeignKey("fk_user_event", "tbl_user_event_assignment", "id_user", "tbl_user", "id", "CASCADE", "RESTRICT");
		
		
		
	}

	public function down()
	{
		 $this->truncateTable('tbl_user_event_assignment');
		 $this->dropTable('tbl_user_event_assignment');
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