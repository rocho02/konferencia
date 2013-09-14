<?php
/* @var $this EventController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Events',
);

$this->menu=array(
	array('label'=> Yii::t("app",'Create Event'), 'url'=>array('create')),
	array('label'=> Yii::t("app",'Manage Event'), 'url'=>array('admin')),
);
?>

<h1>Konferenciák</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
