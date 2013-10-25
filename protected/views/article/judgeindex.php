<?php
/* @var $this ArticleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('app','Articles To Judge'),
);

$this->menu=array(
	//array('label'=>'Manage Article', 'url'=>array('admin')),
);
?>

<h1>Bírálatra jelölt cikkek</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view_judgeindex',
)); ?>
