<?php
/* @var $this SectionController */
/* @var $model Section */

$user = Yii::app()->user;

$event_admin = $model->event->isUserInEvent($user);
$section_admin = $model->isUserInSection($user);
$_admin = Yii::app()->user->checkAccess('admin');

$admin = $event_admin || $section_admin || $_admin;

$allow_guest_message = $model->allow_guest_message;

$this->breadcrumbs=array(
	Yii::t('app','Events')=>array('event/index' ),
	Yii::t('app','Event')=>array('event/view','id'=>$model->id_event ),
	//Yii::t('app','Sections')=>array('section/index', 'event'=> $model->id_event ),
	$model->title,
);

$this->menu=array(
	//array('label'=>Yii::t('app', 'List Section' ), 'url'=>array('index','event'=>$model->id_event)),
	//array('label'=>'Create Section', 'url'=>array('create')),
	array('label'=>Yii::t('app','Update Section'), 'url'=>array('update', 'id'=>$model->id_section),'visible'=>$admin),
	//array('label'=>Yii::t('app','Delete Section'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_section),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Section', 'url'=>array('admin')),
	array('label'=>Yii::t('app','Attach article'), 'url'=>array('addArticle', 'section'=>$model->id_section)),
	array('label'=>Yii::t('app','Add User To section'), 'url'=>array('adduser', 'id'=>$model->id_section),'visible'=>$admin),
	array('label'=>Yii::t('app','Message To Admin'), 'url'=>array('message/sectionAdminMessage', 'section'=>$model->id_section),'visible'=>$admin),
);
?>

<h1>Szekció adatai</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'description',
		array(
            'label' =>Yii::t('app','Allow guest message'),
            'type' => 'raw',
            'value' => "<input onclick='javascript: return false;' type='checkbox' " . ( $model->allow_guest_message == 1 ? "checked='checked'" : "" ) ." >" 
        ),
		'start_time',
		'end_time',
		'humanReadableVisibility',
	),
)); ?>
<br>
<br>
<h3>Csatolt fájlok</h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$articleDataProvider,
	'itemView'=>'_view_article',
)); ?>

