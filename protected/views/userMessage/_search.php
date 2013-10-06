<?php
/* @var $this UserMessageController */
/* @var $model UserMessage */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_user_message'); ?>
		<?php echo $form->textField($model,'id_user_message'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_recepient'); ?>
		<?php echo $form->textField($model,'id_recepient'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_message'); ?>
		<?php echo $form->textField($model,'id_message'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->