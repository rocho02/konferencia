<?php

/**
 * This is the model class for table "tbl_event_registration".
 *
 * The followings are the available columns in table 'tbl_event_registration':
 * @property integer $id_registration
 * @property integer $id_user
 * @property integer $id_event
 * @property integer $reservation
 * @property integer $vegetarian
 * @property string $institut
 *
 * The followings are the available model relations:
 * @property User $idUser
 * @property Event $idEvent
 */
class EventRegistration extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EventRegistration the static model class
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
		return 'tbl_event_registration';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_event, reservation, vegetarian', 'numerical', 'integerOnly'=>true),
			array('institut', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_registration, id_user, id_event, reservation, vegetarian, institut', 'safe', 'on'=>'search'),
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
			'idUser' => array(self::BELONGS_TO, 'User', 'id_user'),
			'idEvent' => array(self::BELONGS_TO, 'Event', 'id_event'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_registration' => 'Id Registration',
			'id_user' => 'Id User',
			'id_event' => 'Id Event',
			'reservation' => Yii::t('app','Reservation'),
			'vegetarian' => Yii::t('app','Vegetarian'),
			'institut' => Yii::t('app','Institut'),
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

		$criteria->compare('id_registration',$this->id_registration);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_event',$this->id_event);
		$criteria->compare('reservation',$this->reservation);
		$criteria->compare('vegetarian',$this->vegetarian);
		$criteria->compare('institut',$this->institut,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}