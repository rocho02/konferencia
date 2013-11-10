<?php
/* @var $this EventController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t("app",'Events'),
);

$this->menu=array(
	array('label'=> Yii::t("app",'Create Event'), 'url'=>array('create') ),
);
?>

<h1>Konferenciák listázása</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
