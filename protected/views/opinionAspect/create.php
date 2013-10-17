<?php
/* @var $this OpinionAspectController */
/* @var $model OpinionAspect */

$this->breadcrumbs=array(
	'Opinion Aspects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OpinionAspect', 'url'=>array('index')),
	array('label'=>'Manage OpinionAspect', 'url'=>array('admin')),
);
?>

<h1>Create OpinionAspect</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,)); ?>