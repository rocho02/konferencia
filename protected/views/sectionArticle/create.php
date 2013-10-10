<?php
/* @var $this SectionArticleController */
/* @var $model SectionArticle */

$this->breadcrumbs=array(
	'Section Articles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SectionArticle', 'url'=>array('index')),
	array('label'=>'Manage SectionArticle', 'url'=>array('admin')),
);
?>

<h1>Attach article</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>