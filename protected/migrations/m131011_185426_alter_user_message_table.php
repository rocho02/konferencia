<?php

class m131011_185426_alter_user_message_table extends CDbMigration
{
	public function up()
	{			
		$sql = "ALTER TABLE tbl_user_message ADD column update_time datetime default NULL"	;
			
		$this->execute($sql);	
		
		$sql = "ALTER TABLE tbl_user_message	ADD column create_user_id int default NULL"	;
			
		$this->execute($sql);	
		
		$sql = "ALTER TABLE tbl_user_message	ADD column create_time datetime default NULL"	;
			
		$this->execute($sql);	
	
		$sql = "ALTER TABLE tbl_user_message	ADD column update_user_id int default NULL"	;
			
		$this->execute($sql);	
	}

	public function down()
	{
		echo "m131011_185426_alter_user_message_table does not support migration down.\n";
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