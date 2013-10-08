<?php
/* @var $this SectionArticleController */
/* @var $model SectionArticle */

$this->breadcrumbs=array(
	'Section Articles'=>array('index'),
	$model->id_section_article,
);

$this->menu=array(
	array('label'=>'List SectionArticle', 'url'=>array('index')),
	array('label'=>'Create SectionArticle', 'url'=>array('create')),
	array('label'=>'Update SectionArticle', 'url'=>array('update', 'id'=>$model->id_section_article)),
	array('label'=>'Delete SectionArticle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_section_article),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SectionArticle', 'url'=>array('admin')),
);
?>

<h1>View SectionArticle #<?php echo $model->id_section_article; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_section_article',
		'id_section',
		'id_article',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
