<?php
/* @var $this ArticleController */
/* @var $data Article */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_name')); ?>:</b>
	<?php echo  CHtml::encode($data->file_name);  ?>
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

	<?php echo CHtml::link(Yii::t( 'app','Write Opinion' ), array('opinion/judgeCreate','article'=>$data->id_article) ) ?>
	<br />

</div>