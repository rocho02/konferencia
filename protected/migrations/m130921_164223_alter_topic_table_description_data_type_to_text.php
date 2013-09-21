<?php

class m130921_164223_alter_topic_table_description_data_type_to_text extends CDbMigration
{
	public function up()
	{
		$sql = "ALTER TABLE tbl_topic	MODIFY column description text not null default ''"	;
			
		$this->execute($sql);	
	}

	public function down()
	{
		echo "m130921_164223_alter_topic_table_description_data_type_to_text does not support migration down.\n";
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