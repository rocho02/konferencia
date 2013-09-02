<?php
/* @var $this TopicControllerController */
/* @var $model Topic */

$this->breadcrumbs=array(
	'Topics'=>array('index'),
	$model->id_topic,
);

$this->menu=array(
	array('label'=>'List Topic', 'url'=>array('index')),
	array('label'=>'Create Topic', 'url'=>array('create')),
	array('label'=>'Update Topic', 'url'=>array('update', 'id'=>$model->id_topic)),
	array('label'=>'Delete Topic', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_topic),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Topic', 'url'=>array('admin')),
);
?>

<h1>View Topic #<?php echo $model->id_topic; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_topic',
		'name_topic',
		'description',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
