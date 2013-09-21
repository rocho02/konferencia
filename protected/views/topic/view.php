<?php
/* @var $this TopicController */
/* @var $model Topic */

$this->breadcrumbs=array(
	'Topics'=>array('index'),
	$model->id_topic,
);

$this->menu=array(
	array('label'=>Yii::t("app",'List Topic'), 'url'=>array('index')),
	array('label'=>Yii::t("app",'Create Topic'), 'url'=>array('create')),
	array('label'=>Yii::t("app",'Update Topic'), 'url'=>array('update', 'id'=>$model->id_topic)),
	array('label'=>Yii::t("app",'Delete Topic'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_topic),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t("app",'Manage Topic'), 'url'=>array('admin')),
);
?>
<?php /*?>
<h1><?php  echo $model->id_topic; ?>. számú téma</h1>
<?php  */?>
<?php /* $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name_topic',
		'description',
		'createUserName',
	),
)); */?>


<h1><?php echo   $model->name_topic; ?></h1>
<?php echo $model->description	?>
	
<br>
<h2><?php echo Yii::t('app', 'Comments')?></h2>
<?php $this->renderPartial('comment.views.comment.commentList', array(
    'model'=>$model
)); ?>
