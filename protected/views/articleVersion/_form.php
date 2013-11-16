<?php
/* @var $this ArticleVersionController */
/* @var $articleVersion ArticleVersion */
/* @var $article Article */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-version-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($article ,$articleVersion)); ?>

	<?php echo $form->hiddenField($articleVersion,'id_article'); ?>
	
	<div class="row">
        <?php echo $form->labelEx($article,'writer'); ?>
        <?php echo $form->textField($article,'writer',   array('style' =>"width : 300px")   ); ?>
        <?php echo $form->error($article,'writer'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($article,'title'); ?>
        <?php echo $form->textField($article,'title', array('style' =>"width : 300px")  ); ?>
        <?php echo $form->error($article,'title'); ?>
    </div>
	
	<div class="row">
		<?php echo $form->labelEx($articleVersion,'document'); ?>
		<?php echo $form->fileField($articleVersion,'document'); ?>
		<?php echo $form->error($articleVersion,'document'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($articleVersion->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->