<?php
/* @var $this EventRegistrationController */
/* @var $model EventRegistration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-registration-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->errorSummary($eventUserForm); ?>
	
	

	<div class="row">
		<?php echo $form->labelEx($model,'reservation'); ?>
		<?php echo $form->checkbox($model,'reservation'); ?>
		<?php echo $form->error($model,'reservation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vegetarian'); ?>
		<?php echo $form->checkbox($model,'vegetarian'); ?>
		<?php echo $form->error($model,'vegetarian'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'institut'); ?>
		<?php echo $form->textField($model,'institut',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'institut'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->