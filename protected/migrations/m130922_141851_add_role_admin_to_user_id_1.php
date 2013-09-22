<?php

class m130922_141851_add_role_admin_to_user_id_1 extends CDbMigration
{
	public function up()
	{
		$sql = "INSERT into tbl_auth_assignment (itemname, userid, bizrule, data) values( 'admin',1,null,'N;')"	;
			
		$this->execute($sql);	
	}

	public function down()
	{
		echo "m130922_141851_add_role_admin_to_user_id_1 does not support migration down.\n";
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