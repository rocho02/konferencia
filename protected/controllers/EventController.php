<?php

class EventController extends EMController {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(
                    'index',
                    'view'
                ),
                'users' => array('*'),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create',
                    'update',
                    'addUser',
                    'opinions',
                    'pdfView',
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

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $event = $this -> loadModel($id, true);

        //public
        $allow = $event -> visibility = Event::VISIBILITY_PUBLIC;

        // user is admin
        if (!$allow)
            $allow = Yii::app() -> user -> checkAccess('admin');

        //or user is event admin of this event
        if (!$allow)
            $allow = $event -> allowCurrentUser(Event::ROLE_EVENT_ADMIN);

        //or user is registered
        if (!$allow)
            $allow = $event -> allowCurrentUser(Event::ROLE_EVENT_REGISTERED);

        //or user is invited
        if (!$allow)
            $allow = $event -> allowCurrentUser(Event::ROLE_EVENT_INVITED);
        
        //or event has public section or user is admin of any section in event
        if (!$allow){
            $allow = sizeof( $event->eventSections ) > 0;
        }

        //if user not allowd, throw exception
        if ( !$allow )
             throw new CHttpException(404, 'The requested page does not exist.');
        
        $eventAdmins = $event -> usersEventAdmin;
        $dpAdmin = new CArrayDataProvider( $eventAdmins, array('id' => 'dpUsers', 'keyField'=>'id')  );
    
        
        $this -> render('view', array('model' => $event,  'dpAdmin' => $dpAdmin));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionPdfView($id) {
        $event = $this -> loadModel($id, true);

        //public
        $allow = $event -> visibility = Event::VISIBILITY_PUBLIC;

        // user is admin
        if (!$allow)
            $allow = Yii::app() -> user -> checkAccess('admin');

        //or user is event admin of this event
        if (!$allow)
            $allow = $event -> allowCurrentUser(Event::ROLE_EVENT_ADMIN);

        //or user is registered
        if (!$allow)
            $allow = $event -> allowCurrentUser(Event::ROLE_EVENT_REGISTERED);

        //or user is invited
        if (!$allow)
            $allow = $event -> allowCurrentUser(Event::ROLE_EVENT_INVITED);
        
        //or event has public section or user is admin of any section in event
        if (!$allow){
            $allow = sizeof( $event->eventSections ) > 0;
        }

        //if user not allowd, throw exception
        if ( !$allow )
             throw new CHttpException(404, 'The requested page does not exist.');
        
        $eventAdmins = $event -> usersEventAdmin;
        $dpAdmin = new CArrayDataProvider( $eventAdmins, array('id' => 'dpUsers', 'keyField'=>'id', )  );
    
        
        //$this -> render('view', array('model' => $event,  'dpAdmin' => $dpAdmin));
        /*
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('view', array('model' => $event,  'dpAdmin' => $dpAdmin), true));
        $html2pdf->Output();
        */
        
        # mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');

        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);

        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('view', array('model' => $event,  'dpAdmin' => $dpAdmin,'exportDate'=>time()), true));

        # Renders image
        // $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));

        # Outputs ready PDF
        $mPDF1->Output();
    }
    


    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Event;
        $model -> visibility = Event::VISIBILITY_PUBLIC;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Event'])) {
            $model -> attributes = $_POST['Event'];
            $model -> start_date = $this -> fixDateTime($model -> start_date, $model -> start_hour, $model -> start_min);
            $model -> end_date = $this -> fixDateTime($model -> end_date, $model -> end_hour, $model -> end_min);

            if ($model -> save()) {

                //assign the user creating the new project as an owner of the project,
                //so they have access to all project features
                $form = new EventUserForm;
                $form -> username = Yii::app() -> user -> name;
                $form -> event = $model;
                $form -> role = Event::ROLE_EVENT_ADMIN;
                if ($form -> validate()) {
                    $form -> assign();
                }

                $this -> redirect(array(
                    'view',
                    'id' => $model -> id_event
                ));
            }
        }

        if (isset($_POST['UnAssignForm'])) {

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

        if (isset($_POST['Event'])) {
            $model -> attributes = $_POST['Event'];

            $model -> start_date = $this -> fixDateTime($model -> start_date, $model -> start_hour, $model -> start_min);
            $model -> end_date = $this -> fixDateTime($model -> end_date, $model -> end_hour, $model -> end_min);

            if ($model -> save())
                $this -> redirect(array(
                    'view',
                    'id' => $model -> id_event
                ));
        } else {
            $model -> start_hour = date('H', strtotime($model -> start_date));
            $model -> start_min = date('i', strtotime($model -> start_date));

            $model -> end_hour = date('H', strtotime($model -> end_date));
            $model -> end_min = date('i', strtotime($model -> end_date));

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
        $events = array();

        if ($user -> checkAccess('admin')) {
            $events = Event::model() -> findAll();
        } else {

            $criteria = new CDbCriteria;

            $condition_event_admin_or_event_is_public = "select distinct e1.id_event from tbl_event e1 left join tbl_user_event_assignment ua1  on e1.id_event = ua1.id_event  and ua1.role = '" . Event::ROLE_EVENT_ADMIN . "' and ua1.id_user = :id_user where ua1.id_event is not null or e1.visibility = :event_visibility";
            $condition_section_admin_or_section_is_pubilc = "select distinct s2.id_event from tbl_section s2 left join tbl_user_section_assignment ua1  on s2.id_section = ua1.id_section  and ua1.role = '" . Section::ROLE_SECTION_ADMIN . "' and ua1.id_user = :id_user where ua1.id_section is not null or s2.visibility = :section_visibility";

            $criteria -> condition = " ( t.id_event in  ( $condition_event_admin_or_event_is_public )  ) or ( t.id_event in  ( $condition_section_admin_or_section_is_pubilc )  )  ";
            $criteria -> params = array(
                ':id_user' => Yii::app() -> user -> id,
                ':section_visibility' => Section::VISIBILITY_PUBLIC,
                ':event_visibility' => Event::VISIBILITY_PUBLIC,
            );

            $events = Event::model() -> with(array(
                'userAssignments' => array('on' => "role ='" . Event::ROLE_EVENT_ADMIN . "'  "),
                'users' => array(),
                'createUser' => array(),
            )) -> findAll($criteria);
        }
        //$dataProvider=new CActiveDataProvider('Event',array(  'criteria'=>$criteria,));
        $dataProvider = new CArrayDataProvider($events, array(
            'keyField' => 'id_event',
            'id' => 'dp_events'
        ));
        $this -> render('index', array('dataProvider' => $dataProvider, ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Event('search');
        $model -> unsetAttributes();
        // clear any default values
        if (isset($_GET['Event']))
            $model -> attributes = $_GET['Event'];

        $this -> render('admin', array('model' => $model, ));
    }

    public function actionOpinions($id) {

        $event = $this -> loadModel($id);

        $criteria = new CDbCriteria;
        $criteria -> order = 't.id_opinion desc';
        //$criteria->condition = 'article.id_article not in ( select id_article form tbl_article xa inner join article_version xav on  xa.id_article = xav.id_article and xav.id_article = '.ArticleVersion::FLAG_ACCEPTED.')';

        $opinions = Opinion::model() -> with(array(
            'aspects' => array('joinType' => 'INNER JOIN'),
            'article' => array('joinType' => 'INNER JOIN', /* 'on'=>'article.id_article not in ( select xa.id_article from tbl_article xa inner join tbl_article_version xav on xa.id_article = xav.id_article and xav.flag= '.ArticleVersion::FLAG_ACCEPTED.')' */),
            'article.sectionArticles' => array('joinType' => 'INNER JOIN'),
            'article.sectionArticles.section' => array(
                'joinType' => 'INNER JOIN',
                'on' => 'section.id_event=' . $event -> id_event
            ),
        )) -> findAll($criteria);
        $dataProvider = new CArrayDataProvider($opinions, array(
            'keyField' => 'id_opinion',
            'id' => 'dp_opinions'
        ));
        $this -> render('opinions', array(
            'dataProvider' => $dataProvider,
            'event' => $event,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Event the loaded model
     * @throws CHttpException
     */
    public function loadModel($id, $sections = false) {
        $model;
        $user = Yii::app() -> user;

        if ($sections == true) {

            $id_user = Yii::app() -> user -> id;

            $joinSections = array();
            if ($user -> checkAccess('admin')) {
                $joinSections = array();
                //do nothing
            } else {
                if ($user -> isGuest) {
                    $joinSections = array('on' => "eventSections.visibility =  " . Section::VISIBILITY_PUBLIC);
                } else {
                    $condition_allowed_sections = "select distinct s1.id_section from tbl_section s1 " . " left outer join tbl_user_section_assignment usa  on s1.id_section = usa.id_section and usa.role = '" . Section::ROLE_SECTION_ADMIN . "' and usa.id_user = $id_user " . " left outer join tbl_user_event_assignment uea  on s1.id_event = uea.id_event and uea.role = '" . Event::ROLE_EVENT_ADMIN . "' and usa.id_user = $id_user " . " where usa.id_section is not null or uea.id_event is not null or s1.visibility =  " . Section::VISIBILITY_PUBLIC;
                    $joinSections = array('on' => "eventSections.id_section in  ( $condition_allowed_sections ) ");
                }
            }

            $model = Event::model() -> with(array(
                'createUser' => array('joinType' => 'INNER JOIN'),
                'eventSections' => $joinSections,
                'eventSections.createUser' => array('alias' => 'section_create_user')
                //'eventSections.userAssignments'
            )) -> findByPk($id);
        } else {
            $model = Event::model() -> findByPk($id);
        }
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Event $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'event-form') {
            echo CActiveForm::validate($model);
            Yii::app() -> end();
        }
    }

    /**
     * Provides a form so that project administrators can
     * associate other users to the project
     */
    public function actionAdduser($id) {
        $event = $this -> loadModel($id);
        $user = Yii::app() -> user;
        if (!$user -> checkAccess("admin") && !$user -> checkAccess(Event::ROLE_EVENT_ADMIN, array('event' => $event))) {
            throw new CHttpException(403, 'You are not authorized to performthis action.');
        }
        $form = new EventUserForm;
        // collect user input data
        if (isset($_POST['EventUserForm'])) {
            $form -> attributes = $_POST['EventUserForm'];
            $form -> event = $event;
            // validate user input
            if ($form -> validate()) {
                if ($form -> assign()) {
                    Yii::app() -> user -> setFlash('success', $form -> username . "has been added to the event.");
                    //reset the form for another user to be associated if desired
                    $form -> unsetAttributes();
                    $form -> clearErrors();
                }
            }
        }
        if (isset($_POST['EventUnAssignForm'])) {
            $unassignForm = new EventUserUnAssignForm;
            $unassignForm -> attributes = $_POST['EventUnAssignForm'];
            $event -> removeUser($unassignForm -> id_user);
            Yii::app() -> user -> setFlash('success', "User has been unassigned from the event.");
        }

        $form -> event = $event;
        $users = $event -> usersEventAdmin;
        $this -> render('adduser', array(
            'model' => $form,
            'users' => $users
        ));
    }

    function fixDateTime($date, $hour, $min) {
        $ts = strtotime($date);

        $ts = $ts + ($hour * 60 * 60);
        $ts = $ts + ($min * 60);

        $d2 = date("Y-m-d H:i", $ts);
        return $d2;
    }

}
