<?php
/* @var $this EventController */
/* @var $model Event */

$user = Yii::app()->user;
$event_admin = $model->allowCurrentUser(Event::ROLE_EVENT_ADMIN ) || $user->checkAccess('admin');
$registered = $model->allowCurrentUser(Event::ROLE_EVENT_REGISTERED);
$authenticated = ! $user->isGuest;
$allow_guest_message = $model->allow_guest_message;

$this->breadcrumbs=array(
	'Events'=>array('index','event'=> $model->id_event),
	$model->title,
);
$this->menu=array(
	array('label'=>Yii::t("app",'List Event'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Event.Index') ),
	array('label'=>Yii::t("app",'Registered Users'), 'url'=>array('eventRegistration/index','event'=>$model->id_event),'visible'=>$event_admin),
	array('label'=>Yii::t("app",'Create Event'), 'url'=>array('create'),'visible'=>$authenticated),
	array('label'=>Yii::t("app",'Update Event'), 'url'=>array('update', 'id'=>$model->id_event),'visible'=>$event_admin),
	array('label'=>Yii::t("app",'Create Section'), 'url'=>array('section/create','event'=>$model->id_event),'visible'=>$event_admin),
	array('label'=>Yii::t("app",'Add User To event'), 'url'=>array('event/adduser','id'=>$model->id_event),'visible'=>$event_admin),
	array('label'=>Yii::t("app",'Article Opinions'), 'url'=>array('event/opinions','id'=>$model->id_event),'visible'=>$event_admin),
	array('label'=>Yii::t("app",'Invitation'), 'url'=>array('auth/user/invite', 'event'=>$model->id_event),'visible'=>$event_admin),
	array('label'=>Yii::t('app','Registration'), 'url'=>array('eventRegistration/create','event'=>$model->id_event),'visible'=> !$user->isGuest && !$registered ),
	array('label'=>Yii::t("app",'Message To Admin'), 'url'=>array('message/eventAdminMessage','event'=>$model->id_event),'visible'=>$allow_guest_message ),
	array('label'=>Yii::t("app",'Export PDF'), 'url'=>array('event/pdfview','id'=>$model->id_event ),'visible'=>true,"linkOptions"=> array("target" =>"_blank")),
);
?>

<h1><?php echo $model->title; ?> konferencia</h1>

<?php 
    if ( isset($exportDate) ){
        echo "Exportálás dátuma:" .  Yii::app()->dateFormatter->formatDateTime(time(), 'medium', 'medium');
        echo "<br/><br/>";
    }
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'start_date',
		'end_date',
		'description',
		array(
		  'label'=> Yii::t('app','Visibility'),
		  'value'=> $model->getHumanReadableVisibility(),
        ),
        array(
            'label' =>Yii::t('app','Allow guest message'),
            'type' => 'raw',
            'value' => "<input onclick='javascript: return false;' type='checkbox' " . ( $model->allow_guest_message == 1 ? "checked='checked'" : "" ) ." >" 
        ),
		'createUserName',
	),
)); ?>
<br><br>
<h2><?php echo Yii::t('app','Administrators') ?></h2>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dpAdmin,
    'columns'=>array(
        'username',
        'name',
        'surname',
    )
));

?>
<br>
<h2> <?php echo Yii::t('app','Sections') ?></h2>
<?php $this->renderPartial('_sections',array(
'eventSections'=>$model->eventSections,
)); ?>