<?php

class m131119_172809_add_role_aritcle_judge_blind extends CDbMigration
{
	public function up(){
	    $authManager=Yii::app()->authManager;
        $role= $authManager->createRole("Article.Judge.Blind");
	}

	public function down(){
		$authManager=Yii::app()->authManager;
        $role= $authManager->removeAuthItem("Article.Judge.Blind");
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