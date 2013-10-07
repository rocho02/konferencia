<?php
/* @var $this MessageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Messages',
);

$this->menu=array(
	array('label'=>Yii::t("app",'Create Message'), 'url'=>array('create')),
	array('label'=>Yii::t("app",'Manage Message'), 'url'=>array('admin')),
);
?>

<h1>Üzenetek</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
