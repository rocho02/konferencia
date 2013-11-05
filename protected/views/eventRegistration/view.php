<?php
/* @var $this EventRegistrationController */
/* @var $model EventRegistration */

$this->breadcrumbs=array(
	'Event Registrations'=>array('index'),
	$model->id_registration,
);

$this->menu=array(
	array('label'=>'List EventRegistration', 'url'=>array('index')),
	array('label'=>'Create EventRegistration', 'url'=>array('create')),
	array('label'=>'Update EventRegistration', 'url'=>array('update', 'id'=>$model->id_registration)),
	array('label'=>'Delete EventRegistration', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_registration),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EventRegistration', 'url'=>array('admin')),
);
?>

<h1>View EventRegistration #<?php echo $model->id_registration; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_registration',
		'id_user',
		'id_event',
		'reservation',
		'vegetarian',
		'institut',
	),
)); ?>
