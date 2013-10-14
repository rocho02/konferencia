<?php
class SectionAddArticleForm extends CFormModel{
	
	public $selectedArticles;
	public $articles;
	public $section;
	
	public function rules(){
		return array(
			array('selectedArticles','uniqueArticle'),
			array('selectedArticles','required'),
		);	
	}
	
	/**
	 * Declares attribute labels
	 */
	 
	public function attributeLabels(){
		return	array('selectedArticles'=> Yii::t('app','Selected Articles'));
	}
	
	
	public function uniqueArticle(){

		 $articles = Article::model()->with( array('sectionArticles'=>array( 'on'=>'sectionArticles.id_section=' .$this->section->id_section, 'joinType' =>'INNER JOIN' )	)	)->findAll( );
		 //print_r( sizeof( $articles) );
		 $attached_key = array();
		 foreach($articles as $attached){
		 	$attached_key[] = $attached->id_article;
		 }
		 
		 $intersection = array_intersect($attached_key, $this->selectedArticles);		 
		 if ( sizeof( $intersection )  > 0 ){
			 $this->addError('selectedArticles',"Some of selected articles are already attached;");
			 return false;
		 }
		 return true;
	}
	
}

?>