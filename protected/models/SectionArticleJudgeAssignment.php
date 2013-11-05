<?php
/**
 * SectionUserForm class.
 * SectionUserForm is the data structure for keeping
 * the form data related to adding an existing user to an section. It is used by the 'Adduser' action of 'SectionController'.
 */
class SectionArticleJudgeAssignment extends CFormModel {
	/**
	 * @var string username of the user being added to the section
	 */
	public $username;
	/**
	 * @var string the role to which the user will be associated within the section
	 */
	public $role;
	/**
	 * @var object an instance of the Section AR model class
	 */
	public $section;
	public $article;
	private $_user;
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated using the verify() method
	 */
	public function rules() {
		return array(
		// username and role are required
		array('username, role', 'required'),
		//username needs to be checked for existence
			array('username', 'exist', 'className' => 'User'),  
			array('username', 'verify'), 
		);
	}

	/**
	 * Authenticates the existence of the user in the system.
	 * If valid, it will also make the association between the user, role and section
	 * This is the 'verify' validator as declared in rules().
	 */
	public function verify($attribute, $params) {
		if (!$this -> hasErrors())// we only want to authenticate when no other input errors are present
		{
			$user = User::model() -> findByAttributes(array('username' => $this -> username));
			if ( $this -> article -> isUserInArticle( $user ) )  {
				$this -> addError('username', Yii::t('app','This user has already been added to the article.'));
			} else {
				$this -> _user = $user;
			}
		}
	}

	public function assign() {
		if ($this -> _user instanceof User) {
			//assign the user, in the specified role, to the section
			$this -> article -> assignUser($this -> _user -> id, $this -> role);
			//add the association, along with the RBAC biz rule, to our RBAC hierarchy
			$auth = Yii::app() -> authManager;
			$bizRule = 'return isset($params["article"]) && $params["article"]->allowCurrentUser("' . $this -> role . '");';
			$auth -> assign($this -> role, $this -> _user -> id, $bizRule);
			return true;
		} else {
			$this -> addError('username', 'Error when attempting to assign this user to the article.');
			return false;
		}
	}

	/**
	 * Generates an array of usernames to use for the autocomplete
	 * TODO: FILTER USERS
	 */
	public function createUsernameList() {
		$sql = "SELECT username FROM tbl_user t ";
		$command = Yii::app() -> db -> createCommand($sql);
		$rows = $command -> queryAll();
		//format it for use with auto complete widget
		$usernames = array();
		foreach ($rows as $row) {
			$usernames[] = $row['username'];
		}
		return $usernames;
	}


	public function attributeLabels(){
		return array(
			'role'=>Yii::t('app','Role')
		);
	}
}