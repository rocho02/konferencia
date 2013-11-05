<?php

class m131104_174425_create_event_registration_table extends CDbMigration
{
	public function up()
	{
	    $this->createTable('tbl_event_registration', array(
	             'id_registration' => 'pk',
                'id_user' => 'int',
                'id_event' => 'int',
                'reservation'=>'int',
                'vegetarian'=>'int',
                'institut' => 'string'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        
        $this->addForeignKey("fk_registration_user", "tbl_event_registration", "id_event", "tbl_event", "id_event", "CASCADE", "RESTRICT");
        $this->addForeignKey("fk_user_registration", "tbl_event_registration", "id_user", "tbl_user", "id", "CASCADE", "RESTRICT");
        
	}

	public function down(){
	    $this->truncateTable('tbl_event_registration');
        $this->dropTable('tbl_event_registration');
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