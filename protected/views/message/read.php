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

<h1><?php echo Yii::t('app','Read Message') ?></h1>

<span style="display: inline-block; width: 120px;">
<b><?php echo CHtml::encode($model->getAttributeLabel('Küldő')); ?>:</b>
</span>
<span style=" display: inline-block; border: 1px solid black; width: 400px; padding: 3px; height:20px; line-height: 20px; vertical-align: middle;">
<?php echo CHtml::encode($model->getSenderUserName()); ?>
</span>
<br />

<span style="display: inline-block; width: 120px;">	
<b><?php echo CHtml::encode($model->getAttributeLabel('Tárgy')); ?>:</b>
</span>
<span style="margin-top: 5px; display: inline-block; border: 1px solid black; width: 400px; padding: 3px; height:20px; line-height: 20px; vertical-align: middle;">
<?php echo   CHtml::encode(   $model->subject) ; ?>
</span>
<br />

<div style="border: 1px solid black; width: 600px; margin-top: 20px; min-height: 200px; padding: 3px;">
	<?php echo   CHtml::encode(   $model->body  ) ; ?>
</div>
