<?php
/* @var $this OpinionController */
/* @var $model Opinion */

$this->breadcrumbs=array(
	'Opinions'=>array('index'),
	$model->id_opinion,
);

$this->menu=array(
	array('label'=>'List Opinion', 'url'=>array('index')),
	array('label'=>'Create Opinion', 'url'=>array('create')),
	array('label'=>'Update Opinion', 'url'=>array('update', 'id'=>$model->id_opinion)),
	array('label'=>'Delete Opinion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_opinion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Opinion', 'url'=>array('admin')),
);
?>

<h1>View Opinion #<?php echo $model->id_opinion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_opinion',
		'id_article',
		'id_article_version',
		'status',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
