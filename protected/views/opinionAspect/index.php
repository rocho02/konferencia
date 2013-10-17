<?php
/* @var $this OpinionAspectController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Opinion Aspects',
);

$this->menu=array(
	array('label'=>'Create OpinionAspect', 'url'=>array('create')),
	array('label'=>'Manage OpinionAspect', 'url'=>array('admin')),
);
?>

<h1>Opinion Aspects</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
