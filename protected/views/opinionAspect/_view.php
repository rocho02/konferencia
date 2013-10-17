<?php
/* @var $this OpinionAspectController */
/* @var $data OpinionAspect */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_opinion_aspect')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_opinion_aspect), array('view', 'id'=>$data->id_opinion_aspect)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_opinion')); ?>:</b>
	<?php echo CHtml::encode($data->id_opinion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('summary')); ?>:</b>
	<?php echo CHtml::encode($data->summary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('opinion')); ?>:</b>
	<?php echo CHtml::encode($data->opinion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->create_user_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_id); ?>
	<br />

	*/ ?>

</div>