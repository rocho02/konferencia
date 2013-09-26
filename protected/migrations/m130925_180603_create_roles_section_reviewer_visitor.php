<?php

class m130925_180603_create_roles_section_reviewer_visitor extends CDbMigration {

	/*
	 *
	 * A jogosultságok köre egy kicsit bonyolultabb:
	 1) adminisztrátorok: bármit csinálhat
	 2) konferenciaszervezok: létrehozhat konferenciát (admin jóváhagyás után),
	 aminél bármit csinálhat
	 3) szekció szervezők: adott konferencián belül létrehozott szekcióknál
	 bármit thet
	 4) szerzők: adott konferenciához hozzárendelheti magát, cikket küldhet be
	 a beállításoknak megfelelő
	 5) reviewrek: a hozzájuk rendelt konferencián a hozzájuk rendelt cikkeket
	 véleményezhetik
	 6) érdeklődők: csak a számukra elérhető adatokat nézhetik
	 * */
	private $_authManager;
	public function up() {
		$this -> _authManager = Yii::app() -> authManager;

		$this->removeOperationsUser();
	
	//create operations
		$this -> _authManager -> createOperation("User.Create", "Create User");
		$this -> _authManager -> createOperation("User.Delete", "Delete User");
		$this -> _authManager -> createOperation("User.Update", "Update User");
		$this -> _authManager -> createOperation("User.Index", "List User");
		
		$this -> _authManager -> createOperation("Topic.Create", "Create Topic");
		$this -> _authManager -> createOperation("Topic.Delete", "Delete Topic");
		$this -> _authManager -> createOperation("Topic.Update", "Update Topic");
		$this -> _authManager -> createOperation("Topic.Index", "List Topic");
		
		$this -> _authManager -> createOperation("Section.Create", "Create Section");
		$this -> _authManager -> createOperation("Section.Delete", "Delete Section");
		$this -> _authManager -> createOperation("Section.Update", "Update Section");
		$this -> _authManager -> createOperation("Section.Index", "List Section");
		
		$this -> _authManager -> createOperation("Comment.Create", "Create Comment");
		$this -> _authManager -> createOperation("Comment.Delete", "Delete Comment");
		$this -> _authManager -> createOperation("Comment.Update", "Update Comment");
		$this -> _authManager -> createOperation("Comment.Index", "List Comment");


		//create new items
		$role_section_admin = $this -> _authManager -> createRole("section_admin", "Section Admin");
		$role_author = $this -> _authManager -> createRole("author", "Author");
		$role_reviewer = $this -> _authManager -> createRole("reviewer", "Reviewer");
		$role_visitor = $this -> _authManager -> createRole("visitor", "Visitor");

		//load existing
		$role_admin = $this -> _authManager -> getAuthItem("admin");
		$role_organizer = $this -> _authManager -> getAuthItem("organizer");
		
		$operations = $this->_authManager->getAuthItems(0);
		
		$role_admin->addChild("User.Create");
		$role_admin->addChild("User.Delete");
		$role_admin->addChild("User.Update");
		$role_admin->addChild("User.Index");
		
		$role_admin->addChild("Topic.Create");
		$role_admin->addChild("Topic.Delete");
		$role_admin->addChild("Topic.Update");
		$role_admin->addChild("Topic.Index");
		
		
		$role_admin->addChild("Section.Create");
		$role_admin->addChild("Section.Delete");
		$role_admin->addChild("Section.Update");
		$role_admin->addChild("Section.Index");
		
		$role_admin->addChild("Comment.Create");
		$role_admin->addChild("Comment.Delete");
		$role_admin->addChild("Comment.Update");
		$role_admin->addChild("Comment.Index");
		
		$role_section_admin ->addChild("Event.Index");
		$role_section_admin->addChild("Section.Create");
		$role_section_admin->addChild("Section.Delete");
		$role_section_admin->addChild("Section.Update");
		$role_section_admin->addChild("Section.Index");
		
		$role_author->addChild("Event.Index");
		$role_author->addChild("Section.Index");
		$role_author->addChild("Topic.Create");
		$role_author->addChild("Topic.Delete");
		$role_author->addChild("Topic.Update");
		$role_author->addChild("Topic.Index");
		
		$role_reviewer->addChild("Event.Index");
		$role_reviewer->addChild("Section.Index");
		$role_reviewer->addChild("Topic.Index");
		$role_reviewer->addChild("Comment.Create");
		
		$role_visitor->addChild("Topic.Index");
		$role_visitor->addChild("Event.Index");
		$role_visitor->addChild("Section.Index");
		$role_visitor->addChild("Comment.Index");
		
	}
	private function removeOperationsUser(){
		$sql = "delete from tbl_auth_item_child where child like '%User'";
		$this->execute($sql);
		
		$sql = "delete from tbl_auth_item where name like '%User'";
		$this->execute($sql);		
	}
	

	public function down() {
		echo "m130925_180603_create_roles_section_reviewer_visitor does not support migration down.\n";
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
