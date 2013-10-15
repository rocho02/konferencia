<?php

class m131015_184033_alter_event_title extends CDbMigration
{
	public function up()
	{
		
		$sql = "ALTER TABLE tbl_event	ADD column title varchar(250) default ''"	;
			
		$this->execute($sql);	
	}

	public function down()
	{
		echo "m131015_184033_alter_event_title does not support migration down.\n";
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