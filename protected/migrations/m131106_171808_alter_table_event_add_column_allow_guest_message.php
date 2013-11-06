<?php

class m131106_171808_alter_table_event_add_column_allow_guest_message extends CDbMigration
{
	public function up()
	{
	    $sql = "ALTER TABLE tbl_event   ADD column allow_guest_message int default 0"   ;
            
        $this->execute($sql);
	}

	public function down()
	{
		echo "m131106_171808_alter_table_event_add_column_allow_guest_message does not support migration down.\n";
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