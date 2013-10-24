<?php

class m131023_170940_add_role_article_judge extends CDbMigration
{
	public function up(){
		
		$this->createTable('tbl_user_article_assignment', array(
				'id_user' => 'int',
				'id_article' => 'int',
				'role' => 'string',
				'PRIMARY KEY (`id_article`,`id_user`)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
		
		$this->addForeignKey("fk_article_user", "tbl_user_article_assignment", "id_article", "tbl_article", "id_article", "CASCADE", "RESTRICT");
		$this->addForeignKey("fk_user_article", "tbl_user_article_assignment", "id_user", "tbl_user", "id", "CASCADE", "RESTRICT");
		
		
		$authManager=Yii::app()->authManager;
		$role= $authManager->createRole("Article.Judge");
	}

	public function down(){
		$authManager=Yii::app()->authManager;
		$role= $authManager->removeAuthItem("Article.Judge");
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