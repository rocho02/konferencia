<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $last_login_time
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class User extends AuthBaseActiveRecord
{
	
	public $password_repeat;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, password, password_repeat, surname, address, name, birthday', 'required','on'=>'register'),
			array('username, email, password, password_repeat,surname, address, name, birthday',  'required'),
			array('create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('username, email, password', 'length', 'max'=>255),
			array('last_login_time, create_time, update_time, title', 'safe'),
			array('password_repeat', 'safe'),
			array('password', 'compare'),
			array('email', 'email'),
			array('email, username', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, email, password, last_login_time, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
		);
		
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'userMessages' => array(self::HAS_MANY, 'UserMessage', 'id_recepient'),
      		'messages' => array(self::HAS_MANY, 'Message', 'id_message','through' => 'userMessages'),
      		'eventAssignments' => array(self::HAS_MANY, 'UserEventAssignment', 'id_user' ),
      		'events' => array(self::HAS_MANY, 'Event', 'id_event' ,'through' => 'eventAssignments'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t("app",'ID'),
			'username' => Yii::t("app",'Username'),
			'title' => Yii::t("app",'Titulus'),
			'surname' => Yii::t("app",'Surname'),
			'name' => Yii::t("app",'Name'),
			'birthday' => Yii::t("app",'Birthday'),
			'address' => Yii::t("app",'Address'),
			'email' => Yii::t("app",'Email'),
			'password' => Yii::t("app",'Password'),
			'password_repeat' => Yii::t("app",'Password Repeat'),
			'last_login_time' => Yii::t("app",'Last Login Time'),
			'create_time' => Yii::t("app",'Create Time'),
			'create_user_id' => Yii::t("app",'Create User'),
			'update_time' => Yii::t("app",'Update Time'),
			'update_user_id' => Yii::t("app",'UpdateUser'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	/**
	* apply a hash on the password before we store it in the database
	*/
	protected function afterValidate()
	{
		parent::afterValidate();
		if(!$this->hasErrors())
			$this->password = $this->hashPassword($this->password);
	}
	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return md5($password);
	}
	
	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password)===$this->password;
	}
	
	
	public function getCreateUserName(){
		$createUser =User::model()->find('id=?',array( $this->create_user_id ));
		
		if ($createUser === null )return " - ";
		 
		return $createUser->username;
	}
	
	public function getUpdateUserName(){
		$updateUser =User::model()->find('id=?',array( $this->update_user_id ));
		
		if ($updateUser === null )return " - ";
		 
		return $updateUser->username;
	}
	
	
}