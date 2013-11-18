<?php

class SectionController extends EMController {
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
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'eventContext + create,index', // we need an event to create a section or list sections
            'sectionContext +  addArticle, addjudge'// we need an event to create a section or list sections
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
                    'pdfview'
                ),
                'users' => array('*'),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create',
                    'update',
                    'addArticle',
                    'adduser',
                    'addjudge'
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
        
        $section = Section::model()->with(
            array(
                'event'
            )
        ) -> findByPk($id);
        if ($section === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        
        $articles = Article::model() -> with( 
            array('sectionArticles' => array(
                'on' => 'sectionArticles.id_section=' . $section -> id_section,
                'joinType' => 'INNER JOIN'
            ),
            )) -> findAll();

        $articleDataProvider = new CArrayDataProvider($articles, array(
            'keyField' => 'id_article',
            'id' => 'articleDP'
        ));

        $sectionAdmins = $section->usersSectionAdmin;
        $dpAdmin = new CArrayDataProvider( $sectionAdmins, array('id' => 'dpUsers', 'keyField'=>'id')  );

        $this -> render('view', array(
            'model' => $section,
            'articles' => $articles,
            'articleDataProvider' => $articleDataProvider,
            'dpAdmin' => $dpAdmin
        ));
    }


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionPdfview($id) {
        
        $section = Section::model()->with(
            array(
                'event'
            )
        ) -> findByPk($id);
        if ($section === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        
        $articles = Article::model() -> with( 
            array('sectionArticles' => array(
                'on' => 'sectionArticles.id_section=' . $section -> id_section,
                'joinType' => 'INNER JOIN'
            ),
            )) -> findAll();

        $articleDataProvider = new CArrayDataProvider($articles, array(
            'keyField' => 'id_article',
            'id' => 'articleDP'
        ));

        $sectionAdmins = $section->usersSectionAdmin;
        $dpAdmin = new CArrayDataProvider( $sectionAdmins, array('id' => 'dpUsers', 'keyField'=>'id')  );

        // $this -> render('view', array(
            // 'model' => $section,
            // 'articles' => $articles,
            // 'articleDataProvider' => $articleDataProvider,
            // 'dpAdmin' => $dpAdmin
        // ));
        
        # mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');

        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);

        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('view', array(
            'model' => $section,
            'articles' => $articles,
            'articleDataProvider' => $articleDataProvider,
            'dpAdmin' => $dpAdmin
        ), true));

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
        $model = new Section;
        $model -> visibility = Section::VISIBILITY_PUBLIC;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Section'])) {

            $model -> attributes = $_POST['Section'];
            
            $model -> start_time = $this -> fixDateTime($model -> start_time, $model -> start_hour, $model -> start_min);
            $model -> end_time = $this -> fixDateTime($model -> end_time, $model -> end_hour, $model -> end_min);

            $model -> id_event = $this -> _event -> id_event;

            if ($model -> save()) {

                $form = new SectionUserForm;
                $form -> username = Yii::app() -> user -> name;
                $form -> section = $model;
                $form -> role = Section::ROLE_SECTION_ADMIN;
                if ($form -> validate()) {  
                    $form -> assign();
                }

                $this -> redirect(array(
                    'event/view',
                    'id' => $this -> _event -> id_event
                ));
            }
        }

        $this -> render('create', array(
            'model' => $model,
            'event' => $this -> _event
        ));
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
            
            $model->start_time = $this->fixDateTime($model->start_time,$model->start_hour,$model->start_min);
            $model->end_time = $this->fixDateTime($model->end_time,$model->end_hour,$model->end_min);
            
            if ($model -> save())
                $this -> redirect(array('view', 'id' => $model -> id_section));
        }else{
            $model->start_hour =   date('H', strtotime($model->start_time) );
            $model->start_min =   date('i', strtotime($model->start_time) );
        
            $model->end_hour =   date('H', strtotime($model->end_time) );
            $model->end_min =   date('i', strtotime($model->end_time) );
        
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
        $criteria -> condition = 'id_event=:id_event';
        $criteria -> params = array(':id_event' => $this -> _event -> id_event);
        /*
         $sections = array();

         if ( $this->isEventAllowed($this->_event)){
         $sections = Section::model()->findAll();
         }

         $dataProvider = CArrayDataProvider($sections ,array('keyField' => 'id_section', 'id'=>'dpSections'));
         */
        $dataProvider = new CActiveDataProvider('Section', array('criteria' => $criteria, ));
        $this -> render('index', array(
            'dataProvider' => $dataProvider,
            'event' => $this -> _event
        ));
    }

    public function actionAddArticle($section) {
        /*
         * */

        $form = new SectionAddArticleForm;
        $articles = Article::model() -> with(array('sectionArticles' => array('on' => 'sectionArticles.id_section=' . $section))) -> findAll();
        $form -> articles = $articles;
        $form -> section = $this -> _section;

        if (isset($_POST['SectionAddArticleForm'])) {
            $form -> attributes = $_POST['SectionAddArticleForm'];
            //print_r($form->selectedArticles);

            if ($form -> validate()) {
                print_r($form -> getErrors());
                $trans = Yii::app() -> db -> beginTransaction();
                try {
                    foreach ($form->selectedArticles as $idArticle) {
                        $sa = new SectionArticle;
                        $sa -> id_section = $form -> section -> id_section;
                        $sa -> id_article = $idArticle;
                        $sa -> save();
                    }
                    $trans -> commit();
                    $this -> redirect(array(
                        'view',
                        'id' => $form -> section -> id_section
                    ));
                } catch(Exception $e) {
                    $trans -> rollback();
                    throw $e;
                }
            }
        }

        $this -> render('addarticle', array('model' => $form));
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
     * Provides a form so that project administrators can
     * associate other users to the project
     */
    public function actionAdduser($id) {
        $section = $this -> loadModel($id);
        $event = Event::model() -> findByPk($section -> id_event);

        if (!$this -> isUserAllowed($event, $section)) {
            throw new CHttpException(403, 'You are not authorized to performthis action.');
        }
        $form = new SectionUserForm;
        // collect user input data
        if (isset($_POST['SectionUserForm'])) {
            $form -> attributes = $_POST['SectionUserForm'];
            $form -> event = $event;
            $form -> section = $section;
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
        
         if (isset($_POST['SectionUserUnassignForm'])) {
            $unassignForm = new SectionUserUnassignForm;
            $unassignForm -> attributes = $_POST['SectionUserUnassignForm'];
            $section->removeUser($unassignForm->id_user);
            Yii::app() -> user -> setFlash('success',   "User has been unassigned from the section.");
        }
        
        $form -> event = $event;
        $form -> section = $section;
        $users = $section->usersSectionAdmin;
        $this -> render('adduser', array('model' => $form,'users'=>$users));
        /*
         */
    }

    function isSectionAllowed($section) {
        return Yii::app() -> user -> checkAccess(Section::ROLE_SECTION_ADMIN, array('section' => $section));
    }

    function isEventAllowed($event) {
        return Yii::app() -> user -> checkAccess(Event::ROLE_EVENT_ADMIN, array('event' => $event));
    }

    function isUserAllowed($event, $section) {
        if ($event == null)
            return false;
        if ($section == null)
            return null;

        return Yii::app() -> user -> checkAccess(Permissions::ROLE_ADMIN, array()) || $this -> isEventAllowed($event) || $this -> isSectionAllowed($section);

    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Section the loaded model
     * @throws CHttpException
     */
    public function loadModel($id ) {
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
    public function filterEventContext($filterChain) {
        //set the project identifier based on GET input request variables
        if (isset($_GET['event']))
            $this -> _event = $this -> loadEvent($_GET['event']);
        else
            throw new CHttpException(403, 'Must specify aan event before	performing this action.');
        //complete the running of other filters and execute the requested action
        $filterChain -> run();
    }

    public function filterSectionContext($filterChain) {
        //set the project identifier based on GET input request variables
        if (isset($_GET['section']))
            $this -> _section = $this -> loadSection($_GET['section']);
        else
            throw new CHttpException(403, 'Must specify a section before	performing this action.');
        //complete the running of other filters and execute the requested action
        $filterChain -> run();
    }

    function fixDateTime($date, $hour, $min) {
        if ( !isset($date)  || strlen(trim($date) ) == 0)
            return "";
        
        $ts = strtotime($date);

        if ( isset($hour) && is_numeric($hour)   )
            $ts = $ts + ($hour * 60 * 60);
        
        if ( isset($min) && is_numeric($min)   )
            $ts = $ts + ($min * 60);

        $d2 = date("Y-m-d H:i", $ts);
        return $d2;
    }

    public function actionAddjudge() {

        $form = new SectionArticleJudgeAssignment;

        $form -> article = Article::model() -> findByPk($_GET['article']);
        
        if (isset($_POST['SectionArticleJudgeAssignment'])) {

            $form -> attributes = $_POST['SectionArticleJudgeAssignment'];

            $form -> section = $this -> _section;
            // validate user input
            if ($form -> validate()) {
                if ($form -> assign()) {
                    Yii::app() -> user -> setFlash('success', $form -> username . "has been added to the event.");
                    //reset the form for another user to be associated if desired
                    $form -> unsetAttributes();
                    $form -> clearErrors();
                    $form -> article = Article::model() -> findByPk($_GET['article']);
                }
            }
        }

        if (isset($_POST['ArticleUserUnassignForm'])) {
            $unassignForm = new ArticleUserUnassignForm;
            $unassignForm -> attributes = $_POST['ArticleUserUnassignForm'];
            $form -> article->removeUser($unassignForm->id_user);
            Yii::app() -> user -> setFlash('success',   "User has been unassigned from the article.");
        }

    
         $users = $form -> article->usersArticleJudge;
    
        $this -> render('addjudge', array(
            'model' => $form,
            'section' => $this -> _section,
            'users' =>$users
        ));
    }

}
