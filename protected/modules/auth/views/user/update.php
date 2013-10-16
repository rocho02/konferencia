<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t("app",'List User'), 'url'=>array('index')),
	array('label'=>Yii::t("app",'CreateUser'), 'url'=>array('create')),
	array('label'=>Yii::t("app",'View User'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t("app",'Manage User'), 'url'=>array('admin')),
);
?>

<h1><?php echo $model->name; ?> módosítása</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>