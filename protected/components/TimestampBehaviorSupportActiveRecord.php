<?php

class TimestampBehaviorSupportActiveRecord extends CActiveRecord {
		
		
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
	
	public function getCreateUserName(){
		$username = "";
		if ( isset( $this->createUser  ) ){
			$username = $this->createUser->username;
		}
		return $username;
	}
	
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
					 'updateUser' => array(self::BELONGS_TO, 'User', 'update_user_id'),
					 'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
					);
	}


}
	
	
	?>