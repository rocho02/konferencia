<?php

class m131208_185621_add_right_section_admin_with_weak extends CDbMigration
{
	public function up()
	{
	     $authManager=Yii::app()->authManager;
        $role= $authManager->createRole("Section.Admin.Weak");
	}

	public function down()
	{
		echo "m131208_185621_add_right_section_admin_with_weak does not support migration down.\n";
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