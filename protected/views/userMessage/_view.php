<?php
/* @var $this UserMessageController */
/* @var $data UserMessage */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user_message')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_user_message), array('view', 'id'=>$data->id_user_message)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_recepient')); ?>:</b>
	<?php echo CHtml::encode($data->id_recepient); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_message')); ?>:</b>
	<?php echo CHtml::encode($data->id_message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>