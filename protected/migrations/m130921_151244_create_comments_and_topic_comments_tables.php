<?php

class m130921_151244_create_comments_and_topic_comments_tables extends CDbMigration
{
	public function up()
	{
		$sql = "CREATE TABLE   `comments` (
		      `id`         int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
		      `message`    text COLLATE utf8_unicode_ci,
		      `userId`     int(11) UNSIGNED DEFAULT NULL,
		      `createDate` datetime DEFAULT NULL,
		      PRIMARY KEY (`id`),
		      KEY `fk_comments_userId` (`userId`)
		    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

 		$this->execute($sql);		
		
		$sql = "CREATE TABLE   `tbl_topic_comments_nm` (
		      `id_topic`    int(11) UNSIGNED NOT NULL,
		      `commentId` int(11) UNSIGNED NOT NULL,
		      PRIMARY KEY (`id_topic`,`commentId`),
		      KEY `fk_topic_comments_comments` (`commentId`),
		      KEY `fk_topic_comments_posts` (`id_topic`)
		    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		
		 $this->execute($sql);
		
	}

	public function down()
	{
		$this->dropTable('topic_comments_nm');
		$this->dropTable('comments');
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