<?php

/**
 * This is the model class for table "tbl_article".
 *
 * The followings are the available columns in table 'tbl_article':
 * @property integer $id_article
 * @property string $file_name
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class Article extends TimestampBehaviorSupportActiveRecord
{
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Article the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('file_name', 'length', 'max'=>255),
			array('writer,title', 'required'),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_article, file_name, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		$array = parent::relations();
		$array['articleVersions'] = array(self::HAS_MANY , 'ArticleVersion', 'id_article');
		$array['acceptedVersions'] = array(self::HAS_MANY , 'ArticleVersion', 'id_article',  'joinType'=>'INNER JOIN', 'on'=>'acceptedVersions.flag = ' . ArticleVersion::FLAG_ACCEPTED );
		$array['sectionArticles'] = array(self::HAS_MANY , 'SectionArticle', 'id_article');
		$array['userAssignments'] = array(self::HAS_MANY , 'UserArticleAssignment', 'id_article');
		$array['users'] = array(self::HAS_MANY, 'User', 'id_user','through'=>'userAssignments');
        $array['usersArticleJudge']  = array(self::HAS_MANY, 'User', 'id_user','through'=>'userAssignments' , 'joinType'=>'INNER JOIN' , 'on'=>"userAssignments.role='" . Permissions::ROLE_ARTICLE_JUDGE . "'" ) ;
        $array['usersArticleJudgeAll']  = array(self::HAS_MANY, 'User', 'id_user','through'=>'userAssignments' , 'joinType'=>'INNER JOIN' , 'on'=>"userAssignments.role in ('" . Permissions::ROLE_ARTICLE_JUDGE 
        . "','". Permissions::ROLE_ARTICLE_JUDGE_BLIND . "' )" ) ;
        $array['opinions'] = array(self::HAS_MANY, 'Opinion', 'id_article',);
		//$array['sectionArticle'] = array(self::HAS_MANY , 'SectionArticle', 'id_article' , 'on'=>'sectionArticle.id_article='.$this->id_article) ;
		return $array;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_article' => Yii::t("app",'Id Article'),
			'file_name' => Yii::t("app",'File Name'),
			'create_time' => Yii::t("app",'Upload Time'),
			'create_user_id' => Yii::t("app",'Create User'),
			'createUserName' => Yii::t("app",'Create User'),
			'update_time' => Yii::t("app",'Update Time'),
			'update_user_id' => Yii::t("app",'Update User'),
			'title' => Yii::t("app",'Title'),
			'writer' => Yii::t("app",'Writer'),
			'currentVersionNumber' => Yii::t('app', 'Version'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_article',$this->id_article);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getCurrentVersion(){
		if ( $this->isNewRecord ){
			return null;
		}
		
		$versions = $this->articleVersions;
		$versionMap = array();
		$versionNumbers = array();
		foreach( $versions as $version ){
			$versionNumbers[] = $version->version;
			$versionMap[$version->version] = $version;
		}	
		if ( sizeof( $versionNumbers ) > 0){
			$version = max($versionNumbers);
			return $versionMap[$version];
		}
		return null;
	}
	
	public function getCurrentVersionNumber(){
		 $version = $this->getCurrentVersion();
		 if ( $version == null )
			return null;
		 
		 return $version->version;
	}

	public function getHighestVersion(){
		if ( $this->isNewRecord ){
			return 1;
		}
		$version = 1;
		$versions = $this->articleVersions;
		$versionNumbers = array();
		foreach( $versions as $version ){
			$versionNumbers[] = $version->version;
		}	
		if ( sizeof( $versionNumbers )){
			$version = max($versionNumbers);
			$version += 1;
		}
		return $version;
	}
	
	public function isAccepted(){
		$criteria = new CDbCriteria;
		$criteria->condition = 't.id_article = :id_article';
		$criteria->params = array(
			':id_article'=>$this->id_article
		);
		
		return sizeof(Article::model()->with(array('acceptedVersions'))->findAll($criteria )) > 0;
	}
	
	
		public function assignUser($idUser, $role)
	{
		$command = Yii::app()->db->createCommand();
		$command->insert('tbl_user_article_assignment', array(
		'role'=>$role,
		'id_user'=>$idUser,
		'id_article'=>$this->id_article,
		));
	}
	
	
	public function removeUser($idUser)
	{
		$command = Yii::app()->db->createCommand();
		$command->delete(
		'tbl_user_article_assignment',
		'id_user=:id_user AND id_article=:id_article',
		array(':id_user'=>$idUser,':id_article'=>$this->id_article));
	}
	
	
	public function allowCurrentUser( $role ){
		$sql = "SELECT * FROM tbl_user_article_assignment WHERE id_article=:id_article AND id_user=:id_user AND role=:role";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":id_article", $this->id_article, PDO::PARAM_INT);
		$command->bindValue(":id_user", Yii::app()->user->getId(), PDO::PARAM_INT);
		$command->bindValue(":role", $role, PDO::PARAM_STR);
		return $command->execute()==1;
	}

	/*
	* Determines whether or not a user is already part of a section
	*/
	public function isUserInArticle($user){
		$sql = "SELECT id_user FROM tbl_user_article_assignment WHERE id_article=:id_article AND id_user=:id_user";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":id_article", $this->id_article, PDO::PARAM_INT);
		$command->bindValue(":id_user", $user->id, PDO::PARAM_INT);
		return $command->execute()==1;
	}
	
	
	public static function getUserRoleOptions()	{
		return array(  Permissions::ROLE_ARTICLE_JUDGE => Yii::t('app','Article Judge' ) , Permissions::ROLE_ARTICLE_JUDGE_BLIND => Yii::t('app','Article Judge Blind' ));
	}

}