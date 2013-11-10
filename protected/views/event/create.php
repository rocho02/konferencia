<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	Yii::t("app",'Events')=>array('index'),
	Yii::t("app",'Create'),
);

$this->menu=array(
	array('label'=>Yii::t("app",'List Event'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Event.Index') ),
	array('label'=>Yii::t("app",'Manage Event'), 'url'=>array('admin'),'visible'=>true ),
);
?>

<h1>Konferencia létrehozása</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>