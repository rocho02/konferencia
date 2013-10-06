<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->id_message,
);

$this->menu=array(
	array('label'=>'List Message', 'url'=>array('index')),
	array('label'=>'Create Message', 'url'=>array('create')),
	array('label'=>'Update Message', 'url'=>array('update', 'id'=>$model->id_message)),
	array('label'=>'Delete Message', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_message),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Message', 'url'=>array('admin')),
);
?>

<h1>View Message #<?php echo $model->id_message; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_message',
		'id_sender',
		'subject',
		'body',
		'flag',
		'create_time',
	),
)); ?>
