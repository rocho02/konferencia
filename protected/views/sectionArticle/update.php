<?php
/* @var $this SectionArticleController */
/* @var $model SectionArticle */

$this->breadcrumbs=array(
	'Section Articles'=>array('index'),
	$model->id_section_article=>array('view','id'=>$model->id_section_article),
	'Update',
);

$this->menu=array(
	array('label'=>'List SectionArticle', 'url'=>array('index')),
	array('label'=>'Create SectionArticle', 'url'=>array('create')),
	array('label'=>'View SectionArticle', 'url'=>array('view', 'id'=>$model->id_section_article)),
	array('label'=>'Manage SectionArticle', 'url'=>array('admin')),
);
?>

<h1>Update SectionArticle <?php echo $model->id_section_article; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>