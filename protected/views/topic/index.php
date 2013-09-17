<?php
/* @var $this TopicController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Topics',
);

$this->menu=array(
	array('label'=>Yii::t("app",'Create Topic'), 'url'=>array('create')),
	array('label'=>Yii::t("app",'Manage Topic'), 'url'=>array('admin')),
);
?>

<h1>Témák</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
