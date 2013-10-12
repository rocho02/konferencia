<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->id_message,
);

$this->menu=array(
	array('label'=>Yii::t("app",'Sent Message'), 'url'=>array('index')),
	array('label'=>Yii::t("app",'Create Message'), 'url'=>array('create')),
	array('label'=>Yii::t("app",'Incoming Messages'), 'url'=>array('incoming')),
);
?>

<h1><?php echo Yii::t('app','Read Message') ?></h1>

<span style="display: inline-block; width: 120px;">
<b><?php echo CHtml::encode($model->getAttributeLabel('Sender')); ?>:</b>
</span>
<span style=" display: inline-block; border: 1px solid black; width: 400px; padding: 3px; height:20px; line-height: 20px; vertical-align: middle;">
<?php echo CHtml::encode($model->getSenderUserName()); ?>
</span>
<br />

<span style="display: inline-block; width: 120px;">	
<b><?php echo CHtml::encode($model->getAttributeLabel('Subject')); ?>:</b>
</span>
<span style="margin-top: 5px; display: inline-block; border: 1px solid black; width: 400px; padding: 3px; height:20px; line-height: 20px; vertical-align: middle;">
<?php echo   CHtml::encode(   $model->subject) ; ?>
</span>
<br />

<?php echo   CHtml::activeTextarea( $model ,'body' ,array('cols'=>65,'rows'=>10, 'readonly'=>'readonly', 'style'=>'margin-top: 20px;' )  ) ; ?>
