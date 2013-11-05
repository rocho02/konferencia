<?php
/* @var $this EventRegistrationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Event Registrations',
);

$this->menu=array(
	array('label'=>'Create EventRegistration', 'url'=>array('create')),
	array('label'=>'Manage EventRegistration', 'url'=>array('admin')),
);
?>

<h1>Event Registrations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
