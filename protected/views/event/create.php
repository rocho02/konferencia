<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t("app",'List Event'), 'url'=>array('index')),
	array('label'=>Yii::t("app",'Manage Event'), 'url'=>array('admin')),
);
?>

<h1>Konferencia létrehozása</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>