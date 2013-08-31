<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->id_event=>array('view','id'=>$model->id_event),
	'Update',
);

$this->menu=array(
	array('label'=>'List Event', 'url'=>array('index')),
	array('label'=>'Create Event', 'url'=>array('create')),
	array('label'=>'View Event', 'url'=>array('view', 'id'=>$model->id_event)),
	array('label'=>'Manage Event', 'url'=>array('admin')),
);
?>

<h1>Update Event <?php echo $model->id_event; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>