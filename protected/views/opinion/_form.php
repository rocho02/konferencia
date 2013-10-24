<?php
/* @var $this OpinionController */
/* @var $model Opinion */
/* @var $aspect Aspect */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'opinion-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php /* echo $form->textField($model,'status'); */ ?>
		<?php echo $form->dropDownList($model,'status',Opinion::getStatusOptions()); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<?php $this->renderPartial('_form_aspect',array(
	'model'=>$aspect,
	'form'=>$form
	)); ?>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->