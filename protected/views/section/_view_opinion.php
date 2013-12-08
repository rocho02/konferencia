<?php
/* $var $data Opinion*/
?>

<div class="view">
	<b><?php echo CHtml::encode($data->aspects[0]->getAttributeLabel(Yii::t('app' ,'Summary'))); ?>:</b>
	<?php echo CHtml::encode($data->aspects[0]->summary); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->article->getAttributeLabel(Yii::t('app' ,'File Name'))); ?>:</b>
	<?php echo CHtml::encode($data->article->file_name); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel(Yii::t('app' ,'Create Time'))); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />
	<?php
		 echo CHtml::link(Yii::t('app' ,"Read Me"),array("opinion/sectionAccept",'section'=>$data->article->sectionArticles[0]->id_section,'opinion'=>$data->id_opinion))
	 ?>
</div>