<?php
/* @var $this OpinionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('app','Events') => array("event/index"),
	Yii::t('app','Event') => array("event/view",'id'=>$section->id_event ),
	Yii::t('app','Section') => array("section/view", 'id'=>$section->id_section),
	//Yii::t('app','Article') => array("article/view",'id'=>$article->id_article),
	Yii::t('app','Opinions'),
);

$this->menu=array(
	// array('label'=>'Create Opinion', 'url'=>array('create')),
	// array('label'=>'Manage Opinion', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Opinions') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
