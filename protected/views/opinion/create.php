<?php
/* @var $this OpinionController */
/* @var $model Opinion */

$this->breadcrumbs=array(
	'Opinions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Opinion', 'url'=>array('index')),
	array('label'=>'Manage Opinion', 'url'=>array('admin')),
);
?>

<h1>Create Opinion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'aspect'=>$aspect,)); ?>