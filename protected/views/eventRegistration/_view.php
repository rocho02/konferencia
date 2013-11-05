<?php
/* @var $this EventRegistrationController */
/* @var $data EventRegistration */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_registration')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_registration), array('view', 'id'=>$data->id_registration)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_event')); ?>:</b>
	<?php echo CHtml::encode($data->id_event); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reservation')); ?>:</b>
	<?php echo CHtml::encode($data->reservation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vegetarian')); ?>:</b>
	<?php echo CHtml::encode($data->vegetarian); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('institut')); ?>:</b>
	<?php echo CHtml::encode($data->institut); ?>
	<br />


</div>