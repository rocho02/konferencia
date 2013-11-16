<?php
/* @var $this ArticleController */
/* @var $data Article */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id_article));  ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->file_name), array('view', 'id'=>$data->id_article));  ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('writer')); ?>:</b>
    <?php echo CHtml::encode($data->writer); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createUserName')); ?>:</b>
	<?php echo CHtml::encode($data->createUserName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currentVersionNumber')); ?>:</b>
	<?php echo CHtml::encode($data->currentVersionNumber); ?>
	<br />

</div>