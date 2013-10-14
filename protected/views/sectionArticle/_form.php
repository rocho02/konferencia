<?php
/* @var $this SectionArticleController */
/* @var $model SectionArticle */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'section-article-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_section'); ?>
		<?php echo $form->textField($model,'id_section'); ?>
		<?php echo $form->error($model,'id_section'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_article'); ?>
		<?php echo $form->textField($model,'id_article'); ?>
		<?php echo $form->error($model,'id_article'); ?>
	</div>

	 

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->