<?php

class m131108_063355_add_role_event_invited extends CDbMigration
{
	public function up(){
	    $authManager=Yii::app()->authManager;
        $role= $authManager->createRole("Event.Invited");
	}

	public function down()
	{
		echo "m131108_063355_add_role_event_invited does not support migration down.\n";
		return false;
	}

}