<?php

class m131006_125013_create_section_tables extends CDbMigration
{
	public function up()
	{
		//create section table
		$this->createTable('tbl_section', array(
				'id_section' => 'pk',
				'title' => 'string',
				'description' => 'string',
				'start_time' => 'datetime DEFAULT NULL',
				'end_time' => 'datetime DEFAULT NULL',
				'visibility' => 'int(11) DEFAULT NULL',
				'id_event' => 'int(11) DEFAULT NULL',
				'create_time' => 'datetime DEFAULT NULL',
				'create_user_id' => 'int(11) DEFAULT NULL',
				'update_time' => 'datetime DEFAULT NULL',
				'update_user_id' => 'int(11) DEFAULT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		
		//create section article table
		$this->createTable('tbl_section_article', array(
				'id_section_article' => 'pk',
				'id_section' => 'int',
				'id_article' => 'int',
				'create_time' => 'datetime DEFAULT NULL',
				'create_user_id' => 'int(11) DEFAULT NULL',
				'update_time' => 'datetime DEFAULT NULL',
				'update_user_id' => 'int(11) DEFAULT NULL',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	
	}

	public function down()
	{
		$this->dropTable('tbl_section_article');
		$this->dropTable('tbl_section');
	}

}