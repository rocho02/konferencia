<?php
/* @var $this SectionArticleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Section Articles',
);

$this->menu=array(
	array('label'=>'Create SectionArticle', 'url'=>array('create')),
	array('label'=>'Manage SectionArticle', 'url'=>array('admin')),
);
?>

<h1>Section Articles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
