<?php

class EventRegistrationController extends Controller
{
    private $_event = null;
    
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
			'eventContext + create'
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
		$model=new EventRegistration;
        $eventUserForm = new EventUserForm;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		
		if(isset($_POST['EventRegistration']))
		{
			$model->attributes=$_POST['EventRegistration'];
            $eventUserForm->username = Yii::app()->user->name;
            $eventUserForm->role = Event::ROLE_EVENT_REGISTERED;
            $eventUserForm->event = $this->_event; 
            
            if ( $model->validate() && $eventUserForm->validate() ){
                $model->id_user = Yii::app()->user->id;
                $model->id_event = $this->_event->id_event;
                try{
        		  $trans = Yii::app()->db->beginTransaction();
                     $eventUserForm->assign();
    		      	 $model->save(false);
                     $trans->commit();
      		         $this->redirect( array( 'event/view','id'=>$this->_event->id_event ) );
                }catch(Exception $e){
                    $trans->rollback();
                    throw $e;                    
                }
            }
		}

		$this->render('create',array(
			'model'=>$model,
			'event'=>$this->_event,
			'eventUserForm'=>$eventUserForm
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

		if(isset($_POST['EventRegistration']))
		{
			$model->attributes=$_POST['EventRegistration'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_registration));
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
		$dataProvider=new CActiveDataProvider('EventRegistration');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EventRegistration('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EventRegistration']))
			$model->attributes=$_GET['EventRegistration'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EventRegistration the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EventRegistration::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EventRegistration $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='event-registration-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function filterEventContext($filterChain) {
        //set the project identifier based on GET input request variables
        if (isset($_GET['event']))
            $this -> _event = $this -> loadEvent($_GET['event']);
        else
            throw new CHttpException(403, 'Must specify aan event before    performing this action.');
        //complete the running of other filters and execute the requested action
        $filterChain -> run();
    }
    
    public function loadEvent($id) {
        $model = Event::model() -> findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
}
