<?php
/* @var $this OpinionAspectController */
/* @var $model OpinionAspect */

$this->breadcrumbs=array(
	'Opinion Aspects'=>array('index'),
	$model->id_opinion_aspect=>array('view','id'=>$model->id_opinion_aspect),
	'Update',
);

$this->menu=array(
	array('label'=>'List OpinionAspect', 'url'=>array('index')),
	array('label'=>'Create OpinionAspect', 'url'=>array('create')),
	array('label'=>'View OpinionAspect', 'url'=>array('view', 'id'=>$model->id_opinion_aspect)),
	array('label'=>'Manage OpinionAspect', 'url'=>array('admin')),
);
?>

<h1>Update OpinionAspect <?php echo $model->id_opinion_aspect; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>