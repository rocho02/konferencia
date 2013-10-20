<?php
/* $var $data Opinion*/
?>

<div class="view">
	<b><?php echo CHtml::encode($data->aspects[0]->getAttributeLabel('summary')); ?>:</b>
	<?php echo CHtml::encode($data->aspects[0]->summary); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->article->getAttributeLabel('file_name')); ?>:</b>
	<?php echo CHtml::encode($data->article->file_name); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />
	<?php
		 echo CHtml::link("Read Me",array("opinion/eventAccept",'section'=>$data->article->sectionArticles[0]->id_section,'opinion'=>$data->id_opinion))
	 ?>
</div>