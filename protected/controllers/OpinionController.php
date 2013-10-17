<?php

class OpinionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public $_article = null;
	public $_section = null;
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			'ArticleContext + create, index',
			'SectionContext + create, index, view'
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
			'section'=>$this->_section
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Opinion;
		$aspect = new OpinionAspect;
		$model->id_article = $this->_article->id_article;
		$model->id_article_version = $this->_article->getCurrentVersion()->id_article_version;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Opinion']) && isset($_POST['OpinionAspect']))
		{
			$model->attributes=$_POST['Opinion'];
			$aspect->attributes=$_POST['OpinionAspect'];
			
			if ( $model->validate() && $aspect->validate()){
			
			$trans = Yii::app()->db->beginTransaction();
			try{
			
				$model->save( );
				$aspect->id_opinion = $model->id_opinion;
				$aspect->save( );
			 	$trans->commit();
				$this->redirect(array('view','id'=>$model->id_opinion,'section'=>$this->_section->id_section));
			}catch(Exception $e){
				$trans->rollback();
			}	
			 
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'aspect'=>$aspect,
			'section'=>$this->_section,
			'article'=>$this->_article
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

		if(isset($_POST['Opinion']) && isset($_POST['OpinionAspect']))
		{
			$model->attributes=$_POST['Opinion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_opinion));
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
		$criteria = new CDBCriteria;
		$criteria->condition = 't.id_article ='.$this->_article->id_article;
		$criteria->order=' t.create_time desc';
		
		$opinions = Opinion::model()
		->with(
			 array( 
			 'aspects'=>array('joinType'=>'INNER JOIN'),
			 'createUser'=>array('joinType'=>'INNER JOIN'),
			 'article.sectionArticles'=>array('joinType'=>'INNER JOIN' ,'on'=>'sectionArticles.id_section = ' . $this->_section->id_section),
			 	 )
			  )
		->findAll($criteria);
		
		//$dataProvider = new CActiveDataProvider('Opinion', array('criteria'=>$criteria));
		$dataProvider = new CArrayDataProvider($opinions,array('keyField'=>'id_opinion' , 'id'=>'dp_opinions'));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'article' =>$this->_article,
			'section'=>$this->_section
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Opinion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Opinion']))
			$model->attributes=$_GET['Opinion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Opinion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Opinion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Opinion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='opinion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public function filterArticleContext($filterChain){
		
		if(isset($_GET['article'])){
			$this->_article = Article::model()->findByPk($_GET['article']);
			if ($this->_article === null)
				throw new CHttpException(404, 'The requested page does not exist.');	
		}else
			throw new CHttpException(403,'Must specify an article before	performing this action.');
		//complete the running of other filters and execute the requested action
		$filterChain->run();
		
	}
	
	
	public function filterSectionContext($filterChain){
		
		if(isset($_GET['section'])){
			$this->_section = Section::model()->findByPk($_GET['section']);
			if ($this->_section === null)
				throw new CHttpException(404, 'The requested page does not exist.');	
		}else
			throw new CHttpException(403,'Must specify a section before	performing this action.');
		//complete the running of other filters and execute the requested action
		$filterChain->run();
		
	}
	
}
