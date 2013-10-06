<?php
/* @var $this UserMessageController */
/* @var $model UserMessage */

$this->breadcrumbs=array(
	'User Messages'=>array('index'),
	$model->id_user_message,
);

$this->menu=array(
	array('label'=>'List UserMessage', 'url'=>array('index')),
	array('label'=>'Create UserMessage', 'url'=>array('create')),
	array('label'=>'Update UserMessage', 'url'=>array('update', 'id'=>$model->id_user_message)),
	array('label'=>'Delete UserMessage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_user_message),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserMessage', 'url'=>array('admin')),
);
?>

<h1>View UserMessage #<?php echo $model->id_user_message; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_user_message',
		'id_recepient',
		'id_message',
		'status',
	),
)); ?>
