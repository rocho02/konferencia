<?php
/* @var $this ArticleVersionController */
/* @var $model ArticleVersion */

$this->breadcrumbs=array(
	'Article Versions'=>array('index'),
	$model->id_article_version,
);

$this->menu=array(
	array('label'=>'List ArticleVersion', 'url'=>array('index')),
	array('label'=>'Create ArticleVersion', 'url'=>array('create')),
	array('label'=>'Update ArticleVersion', 'url'=>array('update', 'id'=>$model->id_article_version)),
	array('label'=>'Delete ArticleVersion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_article_version),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ArticleVersion', 'url'=>array('admin')),
);
?>

<h1>View ArticleVersion #<?php echo $model->id_article_version; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_article_version',
		'id_article',
		'version',
		'original_file_name',
		'path',
		'flag',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
