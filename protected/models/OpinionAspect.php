<?php

/**
 * This is the model class for table "tbl_opinion_aspect".
 *
 * The followings are the available columns in table 'tbl_opinion_aspect':
 * @property integer $id_opinion_aspect
 * @property integer $id_opinion
 * @property string $summary
 * @property string $opinion
 * @property integer $rating
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class OpinionAspect extends TimestampBehaviorSupportActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OpinionAspect the static model class
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
		return 'tbl_opinion_aspect';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('summary,rating,opinion', 'required'),
			array('id_opinion, rating, create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('summary, opinion', 'length', 'max'=>255),
			array('id_opinion,create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_opinion_aspect, id_opinion, summary, opinion, rating, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_opinion_aspect' => 'Id Opinion Aspect',
			'id_opinion' => 'Id Opinion',
			'summary' => 'Summary',
			'opinion' => 'Opinion',
			'rating' => 'Rating',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User',
			'update_time' => 'Update Time',
			'update_user_id' => 'Update User',
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

		$criteria->compare('id_opinion_aspect',$this->id_opinion_aspect);
		$criteria->compare('id_opinion',$this->id_opinion);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('opinion',$this->opinion,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}