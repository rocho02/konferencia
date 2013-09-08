<?php
/* @var $this TopicController */
/* @var $model Topic */

$this->breadcrumbs=array(
	'Topics'=>array('index'),
	$model->id_topic=>array('view','id'=>$model->id_topic),
	'Update',
);

$this->menu=array(
	array('label'=>'List Topic', 'url'=>array('index')),
	array('label'=>'Create Topic', 'url'=>array('create')),
	array('label'=>'View Topic', 'url'=>array('view', 'id'=>$model->id_topic)),
	array('label'=>'Manage Topic', 'url'=>array('admin')),
);
?>

<h1>Update Topic <?php echo $model->id_topic; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>