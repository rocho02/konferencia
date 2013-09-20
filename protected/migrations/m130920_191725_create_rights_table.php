<?php

class m130920_191725_create_rights_table extends CDbMigration
{
	
	/*
	 * create table Rights
(
	itemname varchar(64) not null,
	type integer not null,
	weight integer not null,
	primary key (itemname),
	foreign key (itemname) references AuthItem (name) on delete cascade on update cascade
);
	 * */
	
	public function up()
	{
		$sql = "create table tbl_rights
				(
					itemname varchar(64) not null,
					type integer not null,
					weight integer not null,
					primary key (itemname),
					foreign key (itemname) references tbl_auth_item (name) on delete cascade on update cascade
				)";
		  $this->execute($sql);
		  
	}

	public function down()
	{
		$this->dropTable('tbl_rights');
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