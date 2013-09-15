<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->id_event=>array('view','id'=>$model->id_event),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t("app",'List Event'), 'url'=>array('index')),
	array('label'=>Yii::t("app",'Create Event'), 'url'=>array('create')),
	array('label'=>Yii::t("app",'View Event'), 'url'=>array('view', 'id'=>$model->id_event)),
	array('label'=>Yii::t("app",'Manage Event'), 'url'=>array('admin')),
);
?>

<h1><?php echo $model->id_event; ?>. számú konferencia frissítése</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>