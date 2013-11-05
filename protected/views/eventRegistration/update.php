<?php
/* @var $this EventRegistrationController */
/* @var $model EventRegistration */

$this->breadcrumbs=array(
	'Event Registrations'=>array('index'),
	$model->id_registration=>array('view','id'=>$model->id_registration),
	'Update',
);

$this->menu=array(
	array('label'=>'List EventRegistration', 'url'=>array('index')),
	array('label'=>'Create EventRegistration', 'url'=>array('create')),
	array('label'=>'View EventRegistration', 'url'=>array('view', 'id'=>$model->id_registration)),
	array('label'=>'Manage EventRegistration', 'url'=>array('admin')),
);
?>

<h1>Update EventRegistration <?php echo $model->id_registration; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>