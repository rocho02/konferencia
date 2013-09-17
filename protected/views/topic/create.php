<?php
/* @var $this TopicController */
/* @var $model Topic */

$this->breadcrumbs=array(
	'Topics'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t("app",'List Topic'), 'url'=>array('index')),
	array('label'=>Yii::t("app",'Manage Topic'), 'url'=>array('admin')),
);
?>

<h1>Téma hozzáadása</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>