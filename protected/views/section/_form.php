<?php
/* @var $this SectionController */
/* @var $model Section */
/* @var $form CActiveForm */
?>
<style>
	
	DIV#content DIV.compactRadioGroup {
}
 
DIV#content .compactRadioGroup LABEL,
DIV#content .compactRadioGroup INPUT {
    display: inline;
}

DIV#content .compactRadioGroup LABEL{
	padding-right: 20px;
}
	
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'section-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textarea($model,'description',array('cols'=>60, 'rows'=>5, )); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_time'); ?>
		<?php echo $form->textField($model,'start_time'); ?>
		<?php echo $form->error($model,'start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_time'); ?>
		<?php echo $form->textField($model,'end_time'); ?>
		<?php echo $form->error($model,'end_time'); ?>
	</div>

	<div class="row compactRadioGroup">
		<?php echo $form->labelEx($model,'visibility'); ?>
		<?php echo $form->radioButtonList($model,'visibility', Section::getVisiblityOptions(),array('separator'=> ' 	') ); ?>
		<?php echo $form->error($model,'visibility'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->