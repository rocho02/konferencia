<?php

class m131014_175354_alter_section_visibility extends CDbMigration
{
	public function up()
	{
		$sql = "ALTER TABLE tbl_event	ADD column visibility int default NULL";
			
		$this->execute($sql);	
	}

	public function down()
	{
		echo "m131014_175354_alter_section_visibility does not support migration down.\n";
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