<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'message-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model,'subject'); ?>
        <?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'subject'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'body'); ?>
        <?php echo $form->textArea($model,'body',array('cols'=>50,'rows'=>5,'size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'body'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t("app",'Send') : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->