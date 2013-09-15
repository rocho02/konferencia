<?php

/**
 * This is the model class for table "tbl_event".
 *
 * The followings are the available columns in table 'tbl_event':
 * @property integer $id_event
 * @property string $start_date
 * @property string $end_date
 * @property string $description
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class Event extends CActiveRecord {
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
		return array( array('create_user_id, update_user_id', 'numerical', 'integerOnly' => true), array('description', 'length', 'max' => 255), array('start_date, end_date, create_time, update_time', 'safe'),
		// The following rule is used by search().
		// Please remove those attributes that should not be searched.
		array('id_event, start_date, end_date, description, create_time, create_user_id, update_time, update_user_id', 'safe', 'on' => 'search'), );
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
					);
	}
	
	
	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array('id_event' => Yii::t("app", 'Id Event'), 'start_date' => Yii::t("app", 'Start Date'), 'end_date' => Yii::t("app", 'End Date'), 'description' => Yii::t("app", 'Description'), 'create_time' => Yii::t("app", 'Create Time'), 'create_user_id' => Yii::t("app", 'Create User'), 'update_time' => Yii::t("app", 'Update Time'), 'update_user_id' => Yii::t("app", 'Update User'), );
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
		$criteria -> compare('start_date', $this -> start_date, true);
		$criteria -> compare('end_date', $this -> end_date, true);
		$criteria -> compare('description', $this -> description, true);
		$criteria -> compare('create_time', $this -> create_time, true);
		$criteria -> compare('create_user_id', $this -> create_user_id);
		$criteria -> compare('update_time', $this -> update_time, true);
		$criteria -> compare('update_user_id', $this -> update_user_id);

		return new CActiveDataProvider($this, array('criteria' => $criteria, ));
	}

	public function getFormattedStartDate() {
		$valami = "ez valami";
		return $this -> start_date;
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

}
