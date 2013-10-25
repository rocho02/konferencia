<?php

/**
 * This is the model class for table "tbl_section".
 *
 * The followings are the available columns in table 'tbl_section':
 * @property integer $id_section
 * @property string $title
 * @property string $description
 * @property string $start_time
 * @property string $end_time
 * @property integer $visibility
 * @property integer $id_event
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class Section extends TimestampBehaviorSupportActiveRecord
{
	public $start_hour, $start_min;
	public $end_hour, $end_min;
	const VISIBILITY_PRIVATE = 1;
	const VISIBILITY_PUBLIC = 2;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Section the static model class
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
		return 'tbl_section';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('visibility, id_event, create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('title, description', 'length', 'max'=>255),
			array('start_time, end_time, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_section, title, description, start_time, end_time, visibility, id_event, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		
		$relations = parent::relations();
		$relations['sectionArticles'] = array(self::HAS_MANY , 'SectionArticle', 'id_section');
		return  $relations;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_section' => Yii::t("app",'Id Section'),
			'title' => Yii::t("app",'Title'),
			'description' => Yii::t("app",'Description'),
			'start_time' => Yii::t("app",'Start Date'),
			'start_min' => Yii::t("app", 'Start Time'), 
			'end_time' => Yii::t("app",'End Date'),
			'end_min' => Yii::t("app", 'End Time'), 
			'visibility' => Yii::t("app",'Visibility'),
			'id_event' => Yii::t("app",'Id Event'),
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

		$criteria->compare('id_section',$this->id_section);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('visibility',$this->visibility);
		$criteria->compare('id_event',$this->id_event);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);
		$criteria -> compare('start_hour', $this -> start_hour, true);
		$criteria -> compare('start_min', $this -> start_min, true);
		$criteria -> compare('end_hour', $this -> end_hour, true);
		$criteria -> compare('end_min', $this -> end_min, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getFormattedStartDate() {
		// return $this -> start_date;
		$format_1 = 'Y-m-d';
		$format_2 = 'Y-m-d H:i';//format coming from web page
		$format_3 = 'Y-m-d H:i:s';//format coming from mysql
		$date = null;
		$formatted_date = "";
		
		if (!isset($this -> start_time) )  
			return "";
		$date = DateTime::createFromFormat($format_2,  $this -> start_time);
		if ( $date == false )
			$date = DateTime::createFromFormat($format_3,  $this -> start_time);
		// var_dump($date);
		return  $date == false ? "" : $date->format($format_1) ;
		
	}
	
	public function setFormattedStartDate($start_time){
		$this->start_time = $start_time;
	}
	
	public function getFormattedEndDate() {
		// return $this -> start_date;
		$format_1 = 'Y-m-d';
		$format_2 = 'Y-m-d H:i';//format coming from web page
		$format_3 = 'Y-m-d H:i:s';//format coming from mysql
		$date = null;
		$formatted_date = "";
		
		if (!isset($this -> end_time) )  
			return "";
		$date = DateTime::createFromFormat($format_2,  $this -> end_time);
		if ( $date == false )
			$date = DateTime::createFromFormat($format_3,  $this -> end_time);
		// var_dump($date);
		return  $date == false ? "" : $date->format($format_1) ;
		
	}
	
	public function setFormattedEndDate($end_time){
		$this->end_time = $end_time;
	}
	
	public static function getVisibilityOptions(){
		return array(
			self::VISIBILITY_PRIVATE=>Yii::t('app',"private"),
			self::VISIBILITY_PUBLIC  =>Yii::t('app',"public"),
		);
	} 
	
}