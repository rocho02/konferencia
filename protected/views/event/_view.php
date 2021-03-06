<?php
/* @var $this EventController */
/* @var $data Event */
?>

<div class="view">
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id_event)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	<?php echo  CHtml::encode($data->start_date) ; ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('end_date')); ?>:</b>
	<?php echo CHtml::encode($data->end_date); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->getCreateUserName()); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('visibility')); ?>:</b>
 	<?php $visibilityOptions = Event::getVisibilityOptions();
  	echo CHtml::encode( $data->visibility == null ? "-" : $visibilityOptions[$data->visibility] ); ?>
	
    
	
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_id); ?>
	<br />

	*/ ?>

</div>