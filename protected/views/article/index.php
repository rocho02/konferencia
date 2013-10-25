<?php
/* @var $this ArticleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Articles',
);

$this->menu=array(
	array('label'=> Yii::t('app','Marked For Judge'), 'url'=>array('article/judgeindex')),
	array('label'=> Yii::t('app','Create Article'), 'url'=>array('articleVersion/create')),
	//array('label'=>'Manage Article', 'url'=>array('admin')),
);
?>

<h1>Cikkek listázása</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
