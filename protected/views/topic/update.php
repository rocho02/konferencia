<?php
/* @var $this TopicController */
/* @var $model Topic */

$this->breadcrumbs=array(
	'Topics'=>array('index'),
	$model->id_topic=>array('view','id'=>$model->id_topic),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t("app",'List Topic'), 'url'=>array('index')),
	array('label'=>Yii::t("app",'Create Topic'), 'url'=>array('create')),
	array('label'=>Yii::t("app",'View Topic'), 'url'=>array('view', 'id'=>$model->id_topic)),
	array('label'=>Yii::t("app",'Manage Topic'), 'url'=>array('admin')),
);
?>

<h1><?php echo $model->id_topic; ?>. számú téma frissítése</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>