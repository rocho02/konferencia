<?php
/* @var $this SectionController */
/* @var $model Section */

$this->breadcrumbs=array(
	'Sections'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List Section', 'url'=>array('index')),
	//array('label'=>'Manage Section', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', "Create Section for Event") ?> </h1>
<h2>
<?php
	echo $event->title;
 ?>
</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>