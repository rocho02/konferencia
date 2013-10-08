<?php
/* @var $this SectionArticleController */
/* @var $data SectionArticle */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_section_article')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_section_article), array('view', 'id'=>$data->id_section_article)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_section')); ?>:</b>
	<?php echo CHtml::encode($data->id_section); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_article')); ?>:</b>
	<?php echo CHtml::encode($data->id_article); ?>
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