<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->id_event=>array('view','id'=>$model->id_event),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t("app",'List Event'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Event.Index') ),
	array('label'=>Yii::t("app",'Create Event'), 'url'=>array('create'),'visible'=>true),
	array('label'=>Yii::t("app",'View Event'), 'url'=>array('view', 'id'=>$model->id_event),'visible'=>true),
	array('label'=>Yii::t("app",'Manage Event'), 'url'=>array('admin'),'visible'=>true),
);
?>

<h1><?php echo $model->title; ?> szerkesztése</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>