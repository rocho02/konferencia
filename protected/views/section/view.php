<?php
/* @var $this SectionController */
/* @var $model Section */

$this->breadcrumbs=array(
	'Sections'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Section', 'url'=>array('index','event'=>$model->id_event)),
	//array('label'=>'Create Section', 'url'=>array('create')),
	array('label'=>'Update Section', 'url'=>array('update', 'id'=>$model->id_section)),
	array('label'=>'Delete Section', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_section),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Section', 'url'=>array('admin')),
	array('label'=>'Attach document', 'url'=>array('addArticle', 'section'=>$model->id_section)),
);
?>

<h1>View Section #<?php echo $model->id_section; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_section',
		'title',
		'description',
		'start_time',
		'end_time',
		'visibility',
		'id_event',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
