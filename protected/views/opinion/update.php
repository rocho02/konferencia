<?php
/* @var $this OpinionController */
/* @var $model Opinion */

$this->breadcrumbs=array(
	'Opinions'=>array('index'),
	$model->id_opinion=>array('view','id'=>$model->id_opinion),
	'Update',
);

$this->menu=array(
	array('label'=>'List Opinion', 'url'=>array('index')),
	array('label'=>'Create Opinion', 'url'=>array('create')),
	array('label'=>'View Opinion', 'url'=>array('view', 'id'=>$model->id_opinion)),
	array('label'=>'Manage Opinion', 'url'=>array('admin')),
);
?>

<h1>Update Opinion <?php echo $model->id_opinion; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>