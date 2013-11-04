<?php

/**
 * This is the model class for table "tbl_event".
 *
 * The followings are the available columns in table 'tbl_event':
 * @property integer $id_event
 * @property string $start_date
 * @property string $end_date
 * @property string $description
 * @property integer $visibility
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class Event extends CActiveRecord {
	public $start_hour, $start_min;
	public $end_hour, $end_min;
	const VISIBILITY_PRIVATE = 1;
	const VISIBILITY_PUBLIC = 2;
	
	const ROLE_EVENT_ADMIN = "Event.Admin";
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Event the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'tbl_event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array( 
			array('create_user_id, update_user_id, visibility', 'numerical', 'integerOnly' => true),
		 	array('description', 'length', 'max' => 255),
		 	array('create_time, update_time, start_hour, start_min, end_hour, end_min', 'safe'),
		 	array('formattedStartDate,formattedEndDate,title,start_date, end_date,',  'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_event, start_date, end_date, description, create_time, create_user_id, update_time, update_user_id, visibility', 'safe', 'on' => 'search'), );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
					 'updateUser' => array(self::BELONGS_TO, 'User', 'update_user_id'),
					 'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
					 'eventSections' => array(self::HAS_MANY, 'Section', 'id_event'),
					 'userAssignments' => array(self::HAS_MANY, 'UserEventAssignment', 'id_event'),
					 'users' => array(self::HAS_MANY, 'User', 'id_user','through'=>'userAssignments'),
					 'usersEventAdmin' => array(self::HAS_MANY, 'User', 'id_user','through'=>'userAssignments' , 'joinType'=>'INNER JOIN' , 'on'=>"userAssignments.role='".Event::ROLE_EVENT_ADMIN."'" ) ,
					);
	}
	
	
	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
		'id_event' => Yii::t("app", 'Id Event'), 
		'title' => Yii::t("app", 'Title'),
		'start_date' => Yii::t("app", 'Start Date'), 
		'start_min' => Yii::t("app", 'Start Time'), 
		'end_date' => Yii::t("app", 'End Date'), 
		'end_min' => Yii::t("app", 'End Time'), 
		'description' => Yii::t("app", 'Description'), 
		'visibility' => Yii::t("app", 'Visibility'),
		'create_time' => Yii::t("app", 'Create Time'), 
		'create_user_id' => Yii::t("app", 'Create User'), 
		'update_time' => Yii::t("app", 'Update Time'), 
		'update_user_id' => Yii::t("app", 'Update User'), 
		'createUserName' => Yii::t("app", 'Create User'),
		'role' => Yii::t("app", 'Role'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria -> compare('id_event', $this -> id_event);
		$criteria -> compare('title', $this -> title);
		$criteria -> compare('start_date', $this -> start_date, true);
		$criteria -> compare('start_hour', $this -> start_hour, true);
		$criteria -> compare('start_min', $this -> start_min, true);
		$criteria -> compare('end_date', $this -> end_date, true);
		$criteria -> compare('end_hour', $this -> end_hour, true);
		$criteria -> compare('end_min', $this -> end_min, true);
		$criteria -> compare('description', $this -> description, true);
		$criteria -> compare('visibility',$this->visibility);
		$criteria -> compare('create_time', $this -> create_time, true);
		$criteria -> compare('create_user_id', $this -> create_user_id);
		$criteria -> compare('update_time', $this -> update_time, true);
		$criteria -> compare('update_user_id', $this -> update_user_id);

		return new CActiveDataProvider($this, array('criteria' => $criteria, ));
	}

	public function getFormattedStartDate() {
		// return $this -> start_date;
		$format_1 = 'Y-m-d';
		$format_2 = 'Y-m-d H:i';//format coming from web page
		$format_3 = 'Y-m-d H:i:s';//format coming from mysql
		$date = null;
		$formatted_date = "";
		
		if (!isset($this -> start_date) )  
			return "";
		$date = DateTime::createFromFormat($format_2,  $this -> start_date);
		if ( $date == false )
			$date = DateTime::createFromFormat($format_3,  $this -> start_date);
		// var_dump($date);
		return  $date == false ? "" : $date->format($format_1) ;
		
	}
	
	public function setFormattedStartDate($start_date){
		$this->start_date = $start_date;
	}
	
	public function getFormattedEndDate() {
		// return $this -> start_date;
		$format_1 = 'Y-m-d';
		$format_2 = 'Y-m-d H:i';//format coming from web page
		$format_3 = 'Y-m-d H:i:s';//format coming from mysql
		$date = null;
		$formatted_date = "";
		
		if (!isset($this -> end_date) )  
			return "";
		$date = DateTime::createFromFormat($format_2,  $this -> end_date);
		if ( $date == false )
			$date = DateTime::createFromFormat($format_3,  $this -> end_date);
		// var_dump($date);
		return  $date == false ? "" : $date->format($format_1) ;
		
	}
	
	public function setFormattedEndDate($end_date){
		$this->end_date = $end_date;
	}

	public function getCreateUserName(){
		$username = "";
		if ( isset( $this->createUser  ) ){
			$username = $this->createUser->username;
		}
		return $username;
	}

	protected function beforeSave() {
		if (null !== Yii::app() -> user)
			$id = Yii::app() -> user -> id;
		else
			$id = 1;
		if ($this -> isNewRecord)
			$this -> create_user_id = $id;
		$this -> update_user_id = $id;
		return parent::beforeSave();
	}

	/**
	* Attaches the timestamp behavior to update our create and update
	times
	*/
	public function behaviors()
	{
		return array(
		'CTimestampBehavior' => array(
		'class' => 'zii.behaviors.CTimestampBehavior',
		'createAttribute' => 'create_time',
		'updateAttribute' => 'update_time',
		'setUpdateOnCreate' => true,
		),
		);
	}
	
	
	public function assignUser($idUser, $role)
	{
		$command = Yii::app()->db->createCommand();
		$command->insert('tbl_user_event_assignment', array(
		'role'=>$role,
		'id_user'=>$idUser,
		'id_event'=>$this->id_event,
		));
	}
	
	
	public function removeUser($idUser)
	{
		$command = Yii::app()->db->createCommand();
		$command->delete(
		'tbl_user_event_assignment',
		'id_user=:id_user AND id_event=:id_event',
		array(':id_user'=>$idUser,':id_event'=>$this->id_event));
	}
	
	
	public function allowCurrentUser( $role ){
		$sql = "SELECT * FROM tbl_user_event_assignment WHERE id_event=:id_event AND id_user=:id_user AND role=:role";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":id_event", $this->id_event, PDO::PARAM_INT);
		$command->bindValue(":id_user", Yii::app()->user->getId(), PDO::PARAM_INT);
		$command->bindValue(":role", $role, PDO::PARAM_STR);
		return $command->execute()==1;
	}
	
	
	public static function getVisibilityOptions(){
		return array(
			self::VISIBILITY_PRIVATE=> Yii::t('app',"private"),
			self::VISIBILITY_PUBLIC  =>Yii::t('app', "public"),
		);
	} 
    
    public  function getHumanReadableVisibility(){
        $options =Event::getVisibilityOptions();
        return $options[$this->visibility];
    }

	/**
	* Returns an array of available roles in which a user can be placed	when being added to an event
	*/
	public static function getUserRoleOptions()	{
		return array(  Event::ROLE_EVENT_ADMIN => Yii::t('app','Event Admin' ));
	}
	
	/*
	* Determines whether or not a user is already part of an event
	*/
	public function isUserInEvent($user){
		$sql = "SELECT id_user FROM tbl_user_event_assignment WHERE id_event=:id_event AND id_user=:id_user";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":id_event", $this->id_event, PDO::PARAM_INT);
		$command->bindValue(":id_user", $user->id, PDO::PARAM_INT);
		return $command->execute()==1;
	}
	}
