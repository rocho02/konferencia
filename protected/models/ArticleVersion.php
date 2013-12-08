<?php

/**
 * This is the model class for table "tbl_article_version".
 *
 * The followings are the available columns in table 'tbl_article_version':
 * @property integer $id_article_version
 * @property integer $id_article
 * @property integer $version
 * @property string $original_file_name
 * @property string $path
 * @property integer $flag
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class ArticleVersion extends TimestampBehaviorSupportActiveRecord
{
	const FLAG_NEW = 1;
	const FLAG_REJECTED = 2;
	const FLAG_ACCEPTED = 3;
    const FLAG_WEAK_REJECTED = 4;
    const FLAG_WEAK_ACCEPTED = 5;
	
	 public $document;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticleVersion the static model class
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
		return 'tbl_article_version';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_article, version, flag, create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('original_file_name, path', 'length', 'max'=>255),
			array('create_time, update_time', 'safe'),
			array('document', 'file', 'on'=>'create'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_article_version, id_article, version, original_file_name, path, flag, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
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
		return $array;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_article_version' => Yii::t("app",'Id Article Version'),
			'id_article' => Yii::t("app",'Id Article'),
			'version' => Yii::t("app",'Version'),
			'original_file_name' => Yii::t("app",'Original File Name'),
			'document' => Yii::t("app",'Document'),
			'path' => Yii::t("app",'Path'),
			'flag' => Yii::t("app",'Flag'),
			'create_time' => Yii::t("app",'Create Time'),
			'create_user_id' => Yii::t("app",'Create User'),
			'update_time' => Yii::t("app",'Update Time'),
			'update_user_id' => Yii::t("app",'Update User'),
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

		$criteria->compare('id_article_version',$this->id_article_version);
		$criteria->compare('id_article',$this->id_article);
		$criteria->compare('version',$this->version);
		$criteria->compare('original_file_name',$this->original_file_name,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('flag',$this->flag);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	function getStatusText(){
		switch($this->flag){
			case self::FLAG_ACCEPTED : return Yii::t('app','Accepted');
			case self::FLAG_REJECTED : return Yii::t('app','Rejected');
			case self::FLAG_NEW : return Yii::t('app','New');
		}
	}

	public static function getStatusOptions(){
		return array(
			self::FLAG_ACCEPTED => Yii::t('app','Accepted'),
			self::FLAG_REJECTED => Yii::t('app','Rejected'),
			self::FLAG_NEW => Yii::t('app','New'),
		);
	}
	
}