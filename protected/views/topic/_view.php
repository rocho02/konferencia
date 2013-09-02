<?php
/* @var $this TopicController */
/* @var $data Topic */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_topic')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_topic), array('view', 'id'=>$data->id_topic)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_topic')); ?>:</b>
	<?php echo CHtml::encode($data->name_topic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->create_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_id); ?>
	<br />


</div>