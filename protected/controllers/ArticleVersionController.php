<?php

class ArticleVersionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		$article  =  $this->loadArticle( $this->getIdArticle() ); 
		
		if ( $article == null )		
			$article = new Article; 
		
		$articleVersion=new ArticleVersion;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ArticleVersion']))
		{
			$articleVersion->attributes=$_POST['ArticleVersion'];
			$articleVersion->flag = ArticleVersion::FLAG_NEW;
			if ( isset( $articleVersion->id_article )  && is_numeric( $articleVersion->id_article )){
				$article = $this->loadArticle($articleVersion->id_article);
				if ( $article == null )
					$article = new Article;
			} 
			
			$articleVersion->document=CUploadedFile::getInstance($articleVersion,'document');
			$articleVersion->original_file_name = $articleVersion->document->name;
			
			
			if (   $articleVersion->validate() ){
				$trans = Yii::app()->db->beginTransaction();
				try{
					$saveSuccess = true;
					//save article object if needed
					if ( $article->isNewRecord ){
						$article->file_name = $articleVersion->original_file_name;
						$articleVersion->version = 1;
						$saveSuccess = $article->save();
					}
					
					//save article version object, but before set the reference for article
					$relative_dir = "article" . DIRECTORY_SEPARATOR . $article->id_article;
					if ( $saveSuccess ){
						$articleVersion->path = $relative_dir  . DIRECTORY_SEPARATOR . $articleVersion->version;
						$articleVersion->id_article = $article->id_article;
						$articleVersion->version = $article->getHighestVersion();	
						$saveSuccess = $articleVersion->save(false);
					}
					
					
					$absolute_dir_path  =  Yii::app()->basePath . DIRECTORY_SEPARATOR . $relative_dir;
					if ($saveSuccess ){ 
						if ( !file_exists( $absolute_dir_path  ) ){
						 	mkdir( $absolute_dir_path ,0775,true )	;					
						}
						$articleVersion->document->saveAs( $absolute_dir_path .  DIRECTORY_SEPARATOR . $articleVersion->version );
					}
					
					$trans->commit();
				}catch(Exception $ex){
					 $trans->rollback();
				}
				
			}
			
			//if($articleVersion->save())
			$this->redirect(array('article/view','id'=>$articleVersion->id_article ) );
		}

		$this->render('create',array(
			'articleVersion'=>$articleVersion,
			'article'=>$article,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ArticleVersion']))
		{
			$model->attributes=$_POST['ArticleVersion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_article_version));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ArticleVersion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ArticleVersion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ArticleVersion']))
			$model->attributes=$_GET['ArticleVersion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ArticleVersion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ArticleVersion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ArticleVersion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='article-version-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	function getIdArticle(){
		return HTTPUtil::pg("article");
	}
	
	function loadArticle($id){
		if ( $id == null)
		 	return null;
		return $model=Article::model()->findByPk($id);
	}
	
}
