<?php

class m131013_085714_alter_user_register extends CDbMigration
{
	public function up()
	{
		$sql = "ALTER TABLE tbl_user	ADD column title string default ''"	;
			
		$this->execute($sql);	
	
		$sql = "ALTER TABLE tbl_user	ADD column full_name string default ''"	;
			
		$this->execute($sql);	
		
		$sql = "ALTER TABLE tbl_user ADD column born_date datetime default NULL"	;
			
		$this->execute($sql);	
		
		$sql = "ALTER TABLE tbl_user	ADD column address string default ''"	;
			
		$this->execute($sql);		
	}

	public function down()
	{
		echo "m131013_085714_alter_user_register does not support migration down.\n";
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