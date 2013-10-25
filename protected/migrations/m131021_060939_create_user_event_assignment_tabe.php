<?php

class m131021_060939_create_user_event_assignment_tabe extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_user_section_assignment', array(
				'id_user' => 'int',
				'id_section' => 'int',
				'role' => 'string',
				'PRIMARY KEY (`id_section`,`id_user`)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		
		$this->addForeignKey("fk_section_user", "tbl_user_section_assignment", "id_section", "tbl_section", "id_section", "CASCADE", "RESTRICT");
		$this->addForeignKey("fk_user_section", "tbl_user_section_assignment", "id_user", "tbl_user", "id", "CASCADE", "RESTRICT");
		
		$authManager=Yii::app()->authManager;
		$role= $authManager->createRole("Section.Admin");
	}

	public function down(){
		$this->truncateTable('tbl_user_section_assignment');
		 $this->dropTable('tbl_user_section_assignment');
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