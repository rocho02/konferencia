<?php

class UserController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    private $_event;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'eventContext + invite',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(
                    'index',
                    'view',
                    'register'
                ),
                'users' => array('*'),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create',
                    'update',
                    'invite'
                ),
                'users' => array('@'),
            ),
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(
                    'admin',
                    'delete'
                ),
                'users' => array('admin'),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionRegister() {
        $model = new User('register');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model -> attributes = $_POST['User'];
            $model -> create_user_id = 1;
            $model -> update_user_id = 1;
            if ($model -> save())
                $this -> redirect(array('/site/login'));
        }

        $this -> render('register', array('model' => $model, ));
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
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model -> attributes = $_POST['User'];
            if ($model -> save())
                $this -> redirect(array(
                    'view',
                    'id' => $model -> id
                ));
        }

        $this -> render('create', array('model' => $model, ));
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

        if (isset($_POST['User'])) {
            $model -> attributes = $_POST['User'];
            if ($model -> save())
                $this -> redirect(array(
                    'view',
                    'id' => $model -> id
                ));
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
        $user = Yii::app() -> user;
        $users = array();
        if ($user -> checkAccess('admin')) {
            $users = User::model() -> findAll();
        } else if (!$user -> isGuest) {
            $users[] = User::model() -> findByPk($user -> id);
        }
        $dataProvider = new CArrayDataProvider($users, array(
            'keyField' => 'id',
            'id' => 'dp_users'
        ));
        // $dataProvider=new CActiveDataProvider('User');

        $this -> render('index', array('dataProvider' => $dataProvider, ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new User('search');
        $model -> unsetAttributes();
        // clear any default values
        if (isset($_GET['User']))
            $model -> attributes = $_GET['User'];

        $this -> render('admin', array('model' => $model, ));
    }

    public function actionInvite() {
        $user = Yii::app() -> user;
        $users = array();

        $condition_registered_or_invited = "SELECT id_user
        FROM `tbl_user` `u1`  
        inner JOIN `tbl_user_event_assignment` `ue1` ON (`ue1`.`id_user`=`u1`.`id`)
        and   ue1.role in ('" . Event::ROLE_EVENT_REGISTERED . "','" . Event::ROLE_EVENT_INVITED . "'  )";

        $inviteForm = new InviteForm;

        $criteria = new CDbCriteria;
        $criteria -> condition = "t.id not in (" . $condition_registered_or_invited . ")";

        if (isset($_POST['InviteForm'])) {

            $inviteForm -> attributes = $_POST['InviteForm'];
 
            if ($inviteForm -> validate()) {
                
                $users = User::model() -> findAll($criteria);
                $trans = Yii::app() -> db -> beginTransaction();

                try {

                    $message = new Message;
                    $message -> id_sender = Yii::app() -> user -> id;
                    $message -> subject = Yii::t('app', 'Invitation');
                    $message -> body = Yii::t('app', 'Invitation to event: ' . $this -> _event -> title);
                    $message -> flag = Message::FLAG_INVITATION;
                    $message -> save();

                    $messageObect = new MessageObjectAssignment;
                    $messageObect -> type = MessageObjectAssignment::TYPE_EVENT;
                    $messageObect -> id_object = $this -> _event -> id_event;
                    $messageObect -> id_message = $message -> id_message;

                    $messageObect -> save();

                    foreach ($users as $user) {
                        if (in_array($user -> id, $inviteForm -> invite)) {
                            //assign role
                            $eventUserForm = new EventUserForm;
                            $eventUserForm -> event = $this -> _event;
                            $eventUserForm -> role = Event::ROLE_EVENT_INVITED;
                            $eventUserForm -> _user = $user;
                            $eventUserForm -> assign();

                            //send message
                            $recepient = new UserMessage;
                            $recepient -> id_message = $message -> id_message;
                            $recepient -> id_recepient = $user -> id;
                            $recepient -> status = Message::STATUS_NEW;
                            $recepient -> save();
                        }
                    }

                    $trans -> commit();
                } catch(Exception $e) {
                    $trans -> rollback();
                    throw $e;
                }
            }
        }

        $users = User::model() -> findAll($criteria);
        $users_invited = User::model() -> with(array('eventAssignments' => array(
                'joinType' => 'INNER JOIN',
                'on' => "eventAssignments.role in ( '" . Event::ROLE_EVENT_INVITED . "'  )"
            ), )) -> findAll();

        $usersAvail = array();

        foreach ($users as $u) {

            $ui = new UserInvite;
            $ui -> user = $u;
            $ui -> id = $u -> id;
            $ui -> invited = false;
            $usersAvail[] = $ui;
        }

        $dpUsers = new CArrayDataProvider($usersAvail, array(
            'keyField' => 'id',
            'id' => 'dp_users'
        ));
        $dpInvited = new CArrayDataProvider($users_invited, array(
            'keyField' => 'id',
            'id' => 'dp_invited'
        ));

        $this -> render('invite', array(
            'dpUsers' => $dpUsers,
            'dpInvited' => $dpInvited,
            'model' => $inviteForm
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model() -> findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app() -> end();
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
        if (!($model -> allowCurrentUser(Event::ROLE_EVENT_ADMIN) || Yii::app() -> user -> checkAccess('admin')))
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
