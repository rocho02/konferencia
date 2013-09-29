<?php
/* @var $this EventController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Events',
);

$this->menu=array(
	array('label'=> Yii::t("app",'Create Event'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Event.Create') ),
	array('label'=> Yii::t("app",'Manage Event'), 'url'=>array('admin'),'visible'=>true),
);
?>

<h1>Konferenciák listázása</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
