<?php
/* @var $this EventController */
/* @var $data Event */
?>

<div class="view">
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id_event)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	<?php echo  CHtml::encode($data->formattedStartDate) ; ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('start_min')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->start_hour), array('view', 'id'=>$data->id_event)); ?>
	<?php echo CHtml::link(CHtml::encode($data->start_min), array('view', 'id'=>$data->id_event)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_date')); ?>:</b>
	<?php echo CHtml::encode($data->formattedEndDate); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('end_min')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->end_hour), array('view', 'id'=>$data->id_event)); ?>
	<?php echo CHtml::link(CHtml::encode($data->end_min), array('view', 'id'=>$data->id_event)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->getCreateUserName()); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('visibility')); ?>:</b>
 	<?php 
  	$visibilityOptions = Event::getVisiblityOptions();
  	echo CHtml::encode( $data->visibility == null ? "-" : $visibilityOptions[$data->visibility] ); ?>
	 <br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_id); ?>
	<br />

	*/ ?>

</div>