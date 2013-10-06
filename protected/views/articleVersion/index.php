<?php
/* @var $this ArticleVersionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Article Versions',
);

$this->menu=array(
	array('label'=>'Create ArticleVersion', 'url'=>array('create')),
	array('label'=>'Manage ArticleVersion', 'url'=>array('admin')),
);
?>

<h1>Article Versions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
