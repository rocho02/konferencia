<?php

class m131107_063335_allow_section_guest_message extends CDbMigration
{
	public function up(){

	    $sql = "ALTER TABLE tbl_section   ADD column allow_guest_message int default 0"   ;
        $this->execute($sql);
        
	}

	public function down()
	{
		echo "m131107_063335_allow_section_guest_message does not support migration down.\n";
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