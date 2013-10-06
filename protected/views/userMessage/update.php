<?php
/* @var $this UserMessageController */
/* @var $model UserMessage */

$this->breadcrumbs=array(
	'User Messages'=>array('index'),
	$model->id_user_message=>array('view','id'=>$model->id_user_message),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserMessage', 'url'=>array('index')),
	array('label'=>'Create UserMessage', 'url'=>array('create')),
	array('label'=>'View UserMessage', 'url'=>array('view', 'id'=>$model->id_user_message)),
	array('label'=>'Manage UserMessage', 'url'=>array('admin')),
);
?>

<h1>Update UserMessage <?php echo $model->id_user_message; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>