<?php

class m131005_100132_create_article_table extends CDbMigration
{
	public function up()
	{
		//create article table
		$this->createTable('tbl_article', array(
				'id_article' => 'pk',
				'file_name' => 'string',
				'create_time' => 'datetime DEFAULT NULL',
				'create_user_id' => 'int(11) DEFAULT NULL',
				'update_time' => 'datetime DEFAULT NULL',
				'update_user_id' => 'int(11) DEFAULT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');


	//create article_version table
		$this->createTable('tbl_article_version', array(
				'id_article_version' => 'pk',
				'id_article' => 'int',
				'version' => 'int',
				'original_file_name' => 'string',
				'path' => 'string',
				'flag' => 'int',
				'create_time' => 'datetime DEFAULT NULL',
				'create_user_id' => 'int(11) DEFAULT NULL',
				'update_time' => 'datetime DEFAULT NULL',
				'update_user_id' => 'int(11) DEFAULT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		
	}

	public function down()
	{
		$this->dropTable('tbl_article_version');
		$this->dropTable('tbl_article');
	}

}
