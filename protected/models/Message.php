<?php

/**
 * This is the model class for table "tbl_message".
 *
 * The followings are the available columns in table 'tbl_message':
 * @property integer $id_message
 * @property integer $id_sender
 * @property string $subject
 * @property string $body
 * @property integer $flag
 * @property string $create_time
 */
class Message extends CActiveRecord
{
	public $recepient;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Message the static model class
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
		return 'tbl_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_sender, flag', 'numerical', 'integerOnly'=>true),
			array('subject, body', 'length', 'max'=>255),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_message, id_sender, subject, body, flag, create_time', 'safe', 'on'=>'search'),
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
      'senderUser' => array(self::BELONGS_TO, 'User', 'id_sender'));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_message' => Yii::t("app",'Id Message'),
			'recepient' => Yii::t("app",'Recepient'),
			'id_sender' => Yii::t("app",'Id Sender'),
			'subject' => Yii::t("app",'Subject'),
			'body' => Yii::t("app",'Body'),
			'flag' => Yii::t("app",'Flag'),
			'create_time' => Yii::t("app",'Create Time'),
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

		$criteria->compare('id_message',$this->id_message);
		$criteria->compare('id_sender',$this->id_sender);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('flag',$this->flag);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getSenderUsername(){
  		$username = "";
  		if ( isset( $this->senderUser  ) ){
  		 $username = $this->senderUser->username;
 	 }
  	return $username;
 	}
	
	protected function beforeSave() {
		if (null !== Yii::app() -> user)
			$id = Yii::app() -> user -> id;
		else
			$id = 1;
		if ($this -> isNewRecord)
			$this -> id_sender = $id;
		return parent::beforeSave();
	}

	}