<?php

class m131116_100216_add_article_title_and_writer extends CDbMigration
{
	public function up()
	{
	    $sql = "ALTER TABLE tbl_article   ADD column title varchar(255) default '' , add column writer varchar(255)"   ;
            
        $this->execute($sql);
        
	}

	public function down()
	{
		echo "m131116_100216_add_article_title_and_writer does not support migration down.\n";
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