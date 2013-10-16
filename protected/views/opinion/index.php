<?php
/* @var $this OpinionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Opinions',
);

$this->menu=array(
	array('label'=>'Create Opinion', 'url'=>array('create')),
	array('label'=>'Manage Opinion', 'url'=>array('admin')),
);
?>

<h1>Opinions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
