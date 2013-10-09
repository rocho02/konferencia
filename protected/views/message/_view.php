<?php
/* @var $this MessageController */
/* @var $data Message */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_message')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_message), array('view', 'id'=>$data->id_message)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_sender')); ?>:</b>
	<?php echo CHtml::encode($data->getSenderUserName()); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?php echo CHtml::encode($data->subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('body')); ?>:</b>
	<?php echo CHtml::encode($data->body); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flag')); ?>:</b>
	<?php echo CHtml::encode($data->flag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />


</div>