<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t("app",'Sent Messages'), 'url'=>array('index'),'visible'=>true),
	array('label'=>Yii::t("app",'Incoming Messages'), 'url'=>array('/message/incoming')),
);
?>

<h1>Üzenet írása</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>