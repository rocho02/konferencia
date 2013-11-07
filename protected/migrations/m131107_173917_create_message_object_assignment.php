<?php

class m131107_173917_create_message_object_assignment extends CDbMigration
{
	public function up()
    {
        $this->createTable('tbl_message_object_assignment', array(
                'id_message' => 'int',
                'id_object' => 'int',
                'type' => 'int',
                'PRIMARY KEY (`id_message`,`id_object`,`type`)',
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        
        $this->addForeignKey("fk_message_object", "tbl_message_object_assignment", "id_message", "tbl_message", "id_message", "CASCADE", "RESTRICT");
    }

    public function down(){
        $this->truncateTable('tbl_message_object_assignment');
         $this->dropTable('tbl_message_object_assignment');
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