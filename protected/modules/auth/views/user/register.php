<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);
?>

<h1>Regisztráció</h1>

<?php echo $this->renderPartial('_form_register', array('model'=>$model)); ?>

