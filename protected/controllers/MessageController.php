<?php

class MessageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    private $_event;
    private $_section;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			'eventContext + eventAdminMessage', // we need an event to create a section or list sections
			'sectionContext + sectionAdminMessage'
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
				'actions'=>array('index','view','eventAdminMessage','sectionAdminMessage'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','incoming','read',),
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
		$message = Message::model()->with('userMessages.recepient')->findByPk($id);
		$userMessages = $message->userMessages;
		
		$dataProvider = new CArrayDataProvider( $userMessages, array(
   			'keyField' => 'id_recepient', // PRIMARY KEY attribute of $list member objects
   			'id' => 'recepients'  // ID of the data provider itself
		));
		
		$this->render('view',array(
			'model'=>$message,
			//'recepients'=>$recepients,
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Message;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Message']))
		{
			$model->attributes=$_POST['Message'];
			
			$model->id_sender = Yii::app()->user->id;
			if($model->save()){
				foreach( $model->recepient as $r ){
					$recepient = new UserMessage;
					$recepient->id_message = $model->id_message;
					$recepient->id_recepient = $r;
					$recepient->status = Message::STATUS_NEW;
					$recepient->save();
				}
				$this->redirect(array('view','id'=>$model->id_message));
			}
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Message']))
		{
			$model->attributes=$_POST['Message'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_message));
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
		$dataProvider=new CActiveDataProvider('Message');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	
	public function actionRead($id){
		$message = Message::model()->findByPk($id);
		
		
		$criteria = new CDbCriteria;
		$criteria->condition ="id_message=:id_message and id_recepient=:id_recepient";
		
		$criteria->params=array(':id_message'=>$id,':id_recepient'=>Yii::app()->user->id);
		$userMessage=UserMessage::model()->find($criteria);
		

		if ( $userMessage->status == Message::STATUS_NEW){
			$userMessage->status = Message::STATUS_READ;
			$userMessage->save();		
		}
		
		$this->render('read',array(
			'model'=>$message,
			'userMessage'=>$userMessage
		));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIncoming()
	{
		//$criteria = new CDbCriteria;
		//$criteria->with = array('userMessages' => array('condition' => 'id_recepient= ' .Yii::app()->user->id));
		
		$messages = Message::model()->with(
			array( 
			'userMessages.recepient'=>array('condition'=>'id_recepient=' .Yii::app()->user->id ,'joinType'=>'INNER JOIN', 'order'=>'status,userMessages.create_time desc'),
			//'recepients' =>array('joinType'=>'INNER JOIN',),
			'senderUser' =>array('joinType'=>'LEFT JOIN',),
			 ))->findAll( );
		
		
		$dataProvider = new CArrayDataProvider( $messages, array(
   			'keyField' => 'id_message', // PRIMARY KEY attribute of $list member objects
   			'id' => 'messages'  // ID of the data provider itself
		));
		
		
		
		
		//$dataProvider=new CActiveDataProvider('Message',array('criteria' => $criteria ));
		//$dataProvider=new CArrayDataProvider('Message',array('criteria' => $criteria ));
		$this->render('incoming',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Message('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Message']))
			$model->attributes=$_GET['Message'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
    
    public function actionEventAdminMessage(){
        if ( $this->_event->allow_guest_message != '1')
            throw new CHttpException(404,'The requested page does not exist.');
        $model=new Message;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Message']))
        {
            $model->attributes=$_POST['Message'];
            $eventAdmins = $this->_event->usersEventAdmin;
            $model->id_sender = Yii::app()->user->id;
            $trans = null;
            try{
                $trans= Yii::app()->db->beginTransaction();
                if($model->save()){
                    
                    $messageObect = new MessageObjectAssignment;
                    $messageObect->type= MessageObjectAssignment::TYPE_EVENT;
                    $messageObect->id_object = $this->_event->id_event;
                    $messageObect->id_message = $model->id_message;

                    $messageObect->save();
                    
                    
                    foreach( $eventAdmins as $eventAdmin ){
                        $recepient = new UserMessage;
                        $recepient->id_message = $model->id_message;
                        $recepient->id_recepient = $eventAdmin->id;
                        $recepient->status = Message::STATUS_NEW;
                        $recepient->save();
                    }
                    $trans->commit();
                    $this->redirect(array('event/view','id'=>$this->_event->id_event));
                }
            }catch(Exception $e){
                 if ( $trans != null)   
                    $trans->rollback();
                 
                 throw $e;                
            }
        }

        $this->render('event_admin_message',array(
            'model'=>$model,
            'event'=>$this->_event,
        ));
                
    }


    public function actionSectionAdminMessage(){
        if ( $this->_section->allow_guest_message != '1')
            throw new CHttpException(404,'The requested page does not exist.');
        
        $model=new Message;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Message']))
        {
            $model->attributes=$_POST['Message'];
            $sectionAdmins = $this->_section->usersSectionAdmin;
            $model->id_sender = Yii::app()->user->id;
            $trans = null;
            try{
                $trans= Yii::app()->db->beginTransaction();
                if($model->save()){
                    
                    $messageObect = new MessageObjectAssignment;
                    $messageObect->type= MessageObjectAssignment::TYPE_SECTION;
                    $messageObect->id_object = $this->_section->id_section;
                    $messageObect->id_message = $model->id_message;

                    $messageObect->save();
                    
                    foreach( $sectionAdmins as $sectionAdmin ){
                        $recepient = new UserMessage;
                        $recepient->id_message = $model->id_message;
                        $recepient->id_recepient = $sectionAdmin->id;
                        $recepient->status = Message::STATUS_NEW;
                        $recepient->save();
                    }
                    
                    $trans->commit();
                    $this->redirect(array('section/view','id'=>$this->_section->id_section));
                }
            }catch(Exception $e){
                 if ( $trans != null)   
                    $trans->rollback();
                 
                 throw $e;                
            }
        }

        $this->render('section_admin_message',array(
            'model'=>$model,
            'section'=>$this->_section,
        ));
                
    }



	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Message the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Message::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Message $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='message-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	function getAllUser(){
 		$users = User::model()->findAll();
 		return  CHtml::listData($users,'id', 'username');
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
    
    public function filterSectionContext($filterChain) {
        //set the project identifier based on GET input request variables
        if (isset($_GET['section']))
            $this -> _section = $this -> loadSection($_GET['section']);
        else
            throw new CHttpException(403, 'Must specify a section before    performing this action.');
        //complete the running of other filters and execute the requested action
        $filterChain -> run();
    }
    
    public function loadSection($id) {
        $model = Section::model() -> findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
}
