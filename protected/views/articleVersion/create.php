<?php
/* @var $this ArticleVersionController */
/* @var $model ArticleVersion */

$this->breadcrumbs=array(
	'Article Versions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ArticleVersion', 'url'=>array('index')),
	array('label'=>'Manage ArticleVersion', 'url'=>array('admin')),
);
?>

<h1>Create ArticleVersion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>