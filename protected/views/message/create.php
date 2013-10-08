<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t("app",'List Message'), 'url'=>array('index'),'visible'=>true),
	array('label'=>Yii::t("app",'Manage Message'), 'url'=>array('admin'),'visible'=>true),
);
?>

<h1>Üzenet írása</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>