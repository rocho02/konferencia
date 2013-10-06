<?php
/* @var $this UserMessageController */
/* @var $model UserMessage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-message-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_recepient'); ?>
		<?php echo $form->textField($model,'id_recepient'); ?>
		<?php echo $form->error($model,'id_recepient'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_message'); ?>
		<?php echo $form->textField($model,'id_message'); ?>
		<?php echo $form->error($model,'id_message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->