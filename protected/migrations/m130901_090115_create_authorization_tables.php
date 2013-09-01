<?php

class m130901_090115_create_authorization_tables extends CDbMigration
{
	public function up()
	{
		$this->createTableAuthItem();
		$this->createTableAuthItemChild();
		$this->createTableAuthAssignment();
	}

	public function down()
	{
		$this->dropForeignKey('fk_auth_item_child_parent','tbl_auth_item_child');
		$this->dropForeignKey('fk_auth_item_child_child','tbl_auth_item_child');
		
		$this->dropForeignKey('fk_auth_assignment_itemname','tbl_auth_assignment');	
		$this->dropForeignKey('fk_auth_assignment_userid','tbl_auth_assignment');	
			
		
		$this->truncateTable('tbl_auth_assignment');
		$this->truncateTable('tbl_auth_item_child');
		$this->truncateTable('tbl_auth_item');
		$this->dropTable('tbl_auth_assignment');
		$this->dropTable('tbl_auth_item_child');
		$this->dropTable('tbl_auth_item');
	}

 	private function createTableAuthItem(){
		//create the auth item table
		$this->createTable('tbl_auth_item', array(
			'name' =>'varchar(64) NOT NULL',
			'type' =>'integer NOT NULL',
			'description' =>'text',
			'bizrule' =>'text',
			'data' =>'text',
			'PRIMARY KEY (`name`)',
			), 'ENGINE=InnoDB');
	}


	private function createTableAuthItemChild(){
		
		//create the auth item child table
		$this->createTable('tbl_auth_item_child', array(
			'parent' =>'varchar(64) NOT NULL',
			'child' =>'varchar(64) NOT NULL',
			'PRIMARY KEY (`parent`,`child`)',
			), 'ENGINE=InnoDB');
			
		//the tbl_auth_item_child.parent is a reference to tbl_auth_item.name
		$this->addForeignKey("fk_auth_item_child_parent", "tbl_auth_item_child", "parent", "tbl_auth_item", "name", "CASCADE", "CASCADE");
		//the tbl_auth_item_child.child is a reference to tbl_auth_item.name
		$this->addForeignKey("fk_auth_item_child_child", "tbl_auth_item_child", "child", "tbl_auth_item", "name", "CASCADE", "CASCADE");
	}


	private function createTableAuthAssignment(){
		//create the auth assignment table
		$this->createTable('tbl_auth_assignment', array(
			'itemname' =>'varchar(64) NOT NULL',
			'userid' =>'int(11) NOT NULL',
			'bizrule' =>'text',
			'data' =>'text',
			'PRIMARY KEY (`itemname`,`userid`)',
			), 'ENGINE=InnoDB');
			//the tbl_auth_assignment.itemname is a reference
			//to tbl_auth_item.name
 		$this -> addForeignKey("fk_auth_assignment_itemname", "tbl_auth_assignment", "itemname", "tbl_auth_item", "name", "CASCADE", "CASCADE");//the tbl_auth_assignment.userid is a reference
			//to tbl_user.id
 		$this -> addForeignKey("fk_auth_assignment_userid", "tbl_auth_assignment", "userid", "tbl_user", "id", "CASCADE", "CASCADE");
	}

	

	 
}