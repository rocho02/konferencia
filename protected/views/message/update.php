<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->id_message=>array('view','id'=>$model->id_message),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t("app",'List Message'), 'url'=>array('index')),
	array('label'=>Yii::t("app",'Create Message'), 'url'=>array('create')),
	array('label'=>Yii::t("app",'View Message'), 'url'=>array('view', 'id'=>$model->id_message)),
	array('label'=>Yii::t("app",'Manage Message'), 'url'=>array('admin')),
);
?>

<h1><?php echo $model->subject; ?> tárgyú üzenet szerkesztése</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>