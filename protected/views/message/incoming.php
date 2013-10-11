<?php
/* @var $this MessageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Messages',
);

$this->menu=array(
	array('label'=>Yii::t("app",'Create Message'), 'url'=>array('create')),
	array('label'=>Yii::t("app",'Manage Message'), 'url'=>array('admin')),
	array('label'=>Yii::t("app", Yii::t('app','Elküldött') ), 'url'=>array('index')),
);
?>

<h1>Bejövő Üzenetek</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view_incoming',
)); ?>
