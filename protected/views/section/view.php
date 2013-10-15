<?php
/* @var $this SectionController */
/* @var $model Section */

$this->breadcrumbs=array(
	'Sections'=>array('index', 'event'=> $model->id_event ),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List Section' ), 'url'=>array('index','event'=>$model->id_event)),
	//array('label'=>'Create Section', 'url'=>array('create')),
	array('label'=>Yii::t('app','Update Section'), 'url'=>array('update', 'id'=>$model->id_section)),
	array('label'=>Yii::t('app','Delete Section'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_section),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Section', 'url'=>array('admin')),
	array('label'=>Yii::t('app','Attach article'), 'url'=>array('addArticle', 'section'=>$model->id_section)),
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
<br>
<br>
<h3>Attached Files</h3>
<?php 
	$i = 0;
	foreach ($articles as $a) {
		  $this->widget('zii.widgets.CDetailView', array(
	'data'=>$a,
	'itemCssClass' =>$i%2 ? array('even') : array('odd'),
	'attributes'=>array(
	 	'file_name'
	),
));  
$i++;
	}
?>