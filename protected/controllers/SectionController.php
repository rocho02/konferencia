<?php

class SectionController extends Controller {
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';
	
	private $_event = null;
	private $_section = null;

	/**
	 * @return array action filters
	 */
	public function filters() {
		return array('accessControl', // perform access control for CRUD operations
		'postOnly + delete', // we only allow deletion via POST request
		'eventContext + create,index',// we need an event to create a section or list sections
		'sectionContext +  addArticle'// we need an event to create a section or list sections
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array( array('allow', // allow all users to perform 'index' and 'view' actions
		'actions' => array('index', 'view'), 'users' => array('*'), ), array('allow', // allow authenticated user to perform 'create' and 'update' actions
		'actions' => array('create', 'update', 'addArticle'), 'users' => array('@'), ), array('allow', // allow admin user to perform 'admin' and 'delete' actions
		'actions' => array('admin', 'delete'), 'users' => array('admin'), ), array('deny', // deny all users
		'users' => array('*'), ), );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) {
		$this -> render('view', array('model' => $this -> loadModel($id), ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model = new Section;
		$model->visibility = Section::VISIBILITY_PUBLIC;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Section'])) {
			$model -> attributes = $_POST['Section'];
			$model->id_event = $this->_event->id_event;
			if ($model -> save())
				$this -> redirect(array('event/view', 'id' => $this->_event -> id_event ));
		}

		$this -> render('create', array('model' => $model, 'event'=> $this->_event ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this -> loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Section'])) {
			$model -> attributes = $_POST['Section'];
			if ($model -> save())
				$this -> redirect(array('view', 'id' => $model -> id_section));
		}

		$this -> render('update', array('model' => $model, ));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		$this -> loadModel($id) -> delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this -> redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		
		$criteria = new CDbCriteria;
		$criteria->condition='id_event=:id_event';
		$criteria->params=array(':id_event'=> $this->_event->id_event);
		
		
		
		$dataProvider = new CActiveDataProvider('Section',array('criteria'=>$criteria,));
		$this -> render('index', array('dataProvider' => $dataProvider,'event'=>$this->_event ));
	}
	
	public function actionAddArticle($section) {
		/*
		 * */
		$articles = Article::model()->with(
			array(
				'sectionArticles'=>array('on'=>'sectionArticles.id_section=' .$section)
			)
		)->findAll( );
		/*
		$messages = Message::model()->with(
			array( 
			'userMessages.recepient'=>array('condition'=>'id_recepient=' .Yii::app()->user->id ,'joinType'=>'INNER JOIN', 'order'=>'status,userMessages.create_time desc'),
			//'recepients' =>array('joinType'=>'INNER JOIN',),
			'senderUser' =>array('joinType'=>'INNER JOIN',),
			 ))->findAll( );
		*/
		$this -> render('addArticle', array( 'section'=>$this->_section,'articles'=>$articles ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new Section('search');
		$model -> unsetAttributes();
		// clear any default values
		if (isset($_GET['Section']))
			$model -> attributes = $_GET['Section'];

		$this -> render('admin', array('model' => $model, ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Section the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model = Section::model() -> findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Section $model the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'section-form') {
			echo CActiveForm::validate($model);
			Yii::app() -> end();
		}
	}

	public function loadEvent($id) {
		$model = Event::model() -> findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
	
	public function loadSection($id) {
		$model = Section::model() -> findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}


		/**
	* In-class defined filter method, configured for use in the above
	filters()
	* method. It is called before the actionCreate() action method is run
	in
	* order to ensure a proper project context
	*/
	public function filterEventContext($filterChain)
	{
		//set the project identifier based on GET input request variables
		if(isset($_GET['event']))
			$this->_event = $this->loadEvent($_GET['event']);
		else
			throw new CHttpException(403,'Must specify aan event before	performing this action.');
		//complete the running of other filters and execute the requested action
		$filterChain->run();
	}
	
	public function filterSectionContext($filterChain)
	{
		//set the project identifier based on GET input request variables
		if(isset($_GET['section']))
			$this->_section = $this->loadSection($_GET['section']);
		else
			throw new CHttpException(403,'Must specify a section before	performing this action.');
		//complete the running of other filters and execute the requested action
		$filterChain->run();
	}



}
