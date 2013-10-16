<?php

class m131016_053949_create_article_opinion_tables extends CDbMigration
{
	public function up()
	{
			$this->createTable('tbl_opinion', array(
				'id_opinion' => 'pk',
				'id_article' => 'int not null',
				'id_article_version' => 'int not null',
				'status' => 'int not null default 0',
				'create_time' => 'datetime DEFAULT NULL',
				'create_user_id' => 'int(11) DEFAULT NULL',
				'update_time' => 'datetime DEFAULT NULL',
				'update_user_id' => 'int(11) DEFAULT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		
		
		$this->createTable('tbl_opinion_aspect', array(
				'id_opinion_aspect' => 'pk',
				'id_opinion' => 'int not null',
				'summary' => 'string',
				'opinion' => 'string',
				'rating'=>'int',
				'create_time' => 'datetime DEFAULT NULL',
				'create_user_id' => 'int(11) DEFAULT NULL',
				'update_time' => 'datetime DEFAULT NULL',
				'update_user_id' => 'int(11) DEFAULT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		
	}

	public function down(){
		$this->dropTable('tbl_opinion_aspect');
		$this->dropTable('tbl_opinion');
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