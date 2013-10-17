<?php
/* @var $this OpinionController */
/* @var $data Opinion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->getCreateUserName()); ?>
	<br />

	<b><?php echo CHtml::link( Yii::t('app','Read Me'), array('opinion/view','id'=>$data->id_opinion,'section'=>$data->article->sectionArticles[0]->id_section) ); ?></b>
	

</div>