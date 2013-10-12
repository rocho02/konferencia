<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t("app",'List User'), 'url'=>array('index')),
	array('label'=>Yii::t("app",'Manage User'), 'url'=>array('admin')),
);
?>

<h1>Regisztráció</h1>

<?php echo $this->renderPartial('_form_register', array('model'=>$model)); ?>

