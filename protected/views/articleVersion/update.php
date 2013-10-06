<?php
/* @var $this ArticleVersionController */
/* @var $model ArticleVersion */

$this->breadcrumbs=array(
	'Article Versions'=>array('index'),
	$model->id_article_version=>array('view','id'=>$model->id_article_version),
	'Update',
);

$this->menu=array(
	array('label'=>'List ArticleVersion', 'url'=>array('index')),
	array('label'=>'Create ArticleVersion', 'url'=>array('create')),
	array('label'=>'View ArticleVersion', 'url'=>array('view', 'id'=>$model->id_article_version)),
	array('label'=>'Manage ArticleVersion', 'url'=>array('admin')),
);
?>

<h1>Update ArticleVersion <?php echo $model->id_article_version; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>