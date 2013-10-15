<?php
/* @var $this SectionController */
/* @var $model Section */

$this->breadcrumbs=array(
	'Sections'=>array('index'),
	$model->title=>array('view','id'=>$model->id_section),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t("app",'List Section'), 'url'=>array('index','event'=>$model->id_event)),
	//array('label'=>'Create Section', 'url'=>array('create')),
	array('label'=>Yii::t("app",'View Section'), 'url'=>array('view', 'id'=>$model->id_section)),
	//array('label'=>'Manage Section', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->title; ?> szekció frissítése</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>