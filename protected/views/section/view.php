<?php
/* @var $this SectionController */
/* @var $model Section */

$this->breadcrumbs=array(
	Yii::t('app','Events')=>array('event/index' ),
	Yii::t('app','Event')=>array('event/view','id'=>$model->id_event ),
	Yii::t('app','Sections')=>array('section/index', 'event'=> $model->id_event ),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List Section' ), 'url'=>array('index','event'=>$model->id_event)),
	//array('label'=>'Create Section', 'url'=>array('create')),
	array('label'=>Yii::t('app','Update Section'), 'url'=>array('update', 'id'=>$model->id_section)),
	array('label'=>Yii::t('app','Delete Section'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_section),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Section', 'url'=>array('admin')),
	array('label'=>Yii::t('app','Attach article'), 'url'=>array('addArticle', 'section'=>$model->id_section)),
	array('label'=>Yii::t('app','Add User'), 'url'=>array('adduser', 'id'=>$model->id_section)),
);
?>

<h1><?php echo $model->title; ?> szekció</h1>

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
<br>
<br>
<h3>Csatolt fájlok</h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$articleDataProvider,
	'itemView'=>'_view_article',
)); ?>

