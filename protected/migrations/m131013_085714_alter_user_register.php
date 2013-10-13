<?php

class m131013_085714_alter_user_register extends CDbMigration
{
	public function up()
	{
		$sql = "ALTER TABLE tbl_user	ADD column title varchar(250) default ''"	;
			
		$this->execute($sql);	
	
		$sql = "ALTER TABLE tbl_user	ADD column name varchar(250) default ''"	;
			
		$this->execute($sql);	
		
		$sql = "ALTER TABLE tbl_user	ADD column surname varchar(250) default ''"	;
			
		$this->execute($sql);
		
		$sql = "ALTER TABLE tbl_user ADD column birthday datetime default NULL"	;
			
		$this->execute($sql);	
		
		$sql = "ALTER TABLE tbl_user	ADD column address varchar(500) default ''"	;
			
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