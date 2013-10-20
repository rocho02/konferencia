<?php
class EventOpinionAcceptForm extends CFormModel{
	
	public $article;
	public $articleVersion;
	public $section;
	public $opinion;
	
	public $id_article;
	public $id_article_version;
	public $_reject;
	public $_accept;
	
	public function rules(){
		return array(
			array('','required'),
			array('_accept,_reject','safe'),
		);	
	}
	
	/**
	 * Declares attribute labels
	 */
	 
	public function attributeLabels(){
		return	array('selectedArticles'=> Yii::t('app','Selected Articles'));
	}
	
	
	
}

?>