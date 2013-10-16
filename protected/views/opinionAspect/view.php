<?php
/* @var $this OpinionAspectController */
/* @var $model OpinionAspect */

$this->breadcrumbs=array(
	'Opinion Aspects'=>array('index'),
	$model->id_opinion_aspect,
);

$this->menu=array(
	array('label'=>'List OpinionAspect', 'url'=>array('index')),
	array('label'=>'Create OpinionAspect', 'url'=>array('create')),
	array('label'=>'Update OpinionAspect', 'url'=>array('update', 'id'=>$model->id_opinion_aspect)),
	array('label'=>'Delete OpinionAspect', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_opinion_aspect),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OpinionAspect', 'url'=>array('admin')),
);
?>

<h1>View OpinionAspect #<?php echo $model->id_opinion_aspect; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_opinion_aspect',
		'id_opinion',
		'summary',
		'opinion',
		'rating',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
