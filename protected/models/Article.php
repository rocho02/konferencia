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
		$array['sectionArticles'] = array(self::HAS_MANY , 'SectionArticle', 'id_article');
		//$array['sectionArticle'] = array(self::HAS_MANY , 'SectionArticle', 'id_article' , 'on'=>'sectionArticle.id_article='.$this->id_article) ;
		return $array;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_article' => 'Id Article',
			'file_name' => 'File Name',
			'create_time' => 'Upload Time',
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
	
	

}