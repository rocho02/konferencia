<?php
/* @var $this TopicController */
/* @var $model Topic */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'topic-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name_topic'); ?>
		<?php echo $form->textField($model,'name_topic',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name_topic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('cols'=>50,'rows'=>5,'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t("app",'Create') : Yii::t("app",'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->