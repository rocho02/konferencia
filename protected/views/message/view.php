<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->id_message,
);

$this->menu=array(
	array('label'=>Yii::t("app",'List Message'), 'url'=>array('index')),
	array('label'=>Yii::t("app",'Create Message'), 'url'=>array('create')),
	array('label'=>Yii::t("app",'Update Message'), 'url'=>array('update', 'id'=>$model->id_message)),
	array('label'=>Yii::t("app",'Delete Message'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_message),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t("app",'Manage Message'), 'url'=>array('admin')),
);
?>

<h1><?php echo $model->subject; ?> tárgyú üzenet szerkesztése</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_message',
		'id_sender',
		'subject',
		'body',
		'flag',
		'create_time',
	),
)); ?>
<br/class="<br/>">
<h2><?php  echo Yii::t('app','Recepients') ?></h2>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view_user',
)); ?>