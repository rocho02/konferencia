<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->id_event,
);

$this->menu=array(
	array('label'=>Yii::t("app",'List Event'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Event.Index') ),
	array('label'=>Yii::t("app",'Create Event'), 'url'=>array('create'),'visible'=>true),
	array('label'=>Yii::t("app",'Update Event'), 'url'=>array('update', 'id'=>$model->id_event),'visible'=>true),
	array('label'=>Yii::t("app",'Delete Event'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_event),'confirm'=>'Are you sure you want to delete this item?'),'visible'=>true),
	array('label'=>Yii::t("app",'Manage Event'), 'url'=>array('admin'),'visible'=>true),
);
?>

<h1><?php echo $model->id_event; ?>. számú konferencia</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'formattedStartDate',
		'formattedEndDate',
		'description',
		'createUserName',
	),
)); ?>
