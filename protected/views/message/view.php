<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->id_message,
);

$this->menu=array(
	array('label'=>Yii::t("app",'Sent Messages'), 'url'=>array('index')),
	array('label'=>Yii::t("app",'Create Message'), 'url'=>array('create')),
	array('label'=>Yii::t("app",'Incoming Messages'), 'url'=>array('/message/incoming')),
);
?>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
		'name'=>'id_sender',
		'value'=>CHtml::encode($model->getSenderUserName())
		),
		'create_time',
		'subject',
	),
)); ?>

<div style='border: 1px solid black; width: 600px; min-height: 200px; padding: 5px; margin-top: 20px;'>
	<?php echo $model->body ?>
</div>

<br/class="<br/>">
<h2><?php  echo Yii::t('app','Recepients') ?></h2>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view_user',
)); ?>