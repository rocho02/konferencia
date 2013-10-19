<?php
/* @var $this ArticleVersionController */
/* @var $model ArticleVersion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-version-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($articleVersion); ?>

	<?php echo $form->hiddenField($articleVersion,'id_article'); ?>
	
	<div class="row">
		<?php echo $form->labelEx($articleVersion,'original_file_name'); ?>
		<?php echo $form->fileField($articleVersion,'document'); ?>
		<?php echo $form->error($articleVersion,'original_file_name'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($articleVersion->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->