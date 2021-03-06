<?php
/* @var $this UserController */
/* @var $model User */

$is_admin = Yii::app()->user->checkAccess('admin');

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t("app",'List User'), 'url'=>array('index'),'visible'=>$is_admin),
	array('label'=>Yii::t("app",'CreateUser'), 'url'=>array('create'),'visible'=>$is_admin),
	array('label'=>Yii::t("app",'Update User'), 'url'=>array('update', 'id'=>$model->id),'visible'=>$is_admin),
	array('label'=>Yii::t("app",'Delete User'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),'visible'=>$is_admin),
	array('label'=>Yii::t("app",'Manage User'), 'url'=>array('admin'),'visible'=>$is_admin),
);
?>

<h1><?php echo $model->username; ?> profillapja</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'email',
		'last_login_time',
		'create_time',
		array(
		'name'=>'create_user_id',
		'value'=>CHtml::encode($model->getCreateUserName())
		),
			
		'update_time',
		array(
		'name'=>'update_user_id',
		'value'=>CHtml::encode($model->username)
		),
	),
)); ?>
