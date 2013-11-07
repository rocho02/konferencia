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
		<?php //echo $form->textField($model,'start_date'); 
		
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	  		  'name'=>'Section[formattedStartDate]',
	  		  'value'=>$model->getFormattedStartDate(),
	   		 // additional javascript options for the date picker plugin
	    	'options'=>array(
	        'showAnim'=>'fold',
	        'dateFormat' => 'yy-mm-dd'
	   		 ),
	    	'htmlOptions'=>array(
	        'style'=>'height:20px;'
	   	 ),
		));
		
		?>
		
		<?php echo $form->error($model,'formattedStartDate'); ?>
	</div>
	
		<div class="row">
		<?php echo $form->labelEx($model,'start_min'); ?>
		<?php echo $form->textField($model,'start_hour',array('size'=>2,'maxlength'=>2)); ?>  
		<?php echo $form->error($model,'start_hour'); ?>
		<?php echo $form->textField($model,'start_min',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'start_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_time'); ?>
		<?php 
			//echo $form->textField($model,'end_date'); 
		
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	  		  'name'=>'Section[formattedEndDate]',
	  		  'value'=>$model->getFormattedEndDate(),
	   		 // additional javascript options for the date picker plugin
	    	'options'=>array(
	        'showAnim'=>'fold',
	  		  'dateFormat' => 'yy-mm-dd'
	   		 ),
	    	'htmlOptions'=>array(
	        'style'=>'height:20px;'
	   	 ),
		));
		?>
		<?php echo $form->error($model,'formattedEndDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_min'); ?>
		<?php echo $form->textField($model,'end_hour',array('size'=>2,'maxlength'=>2)); ?>  
		<?php echo $form->error($model,'end_hour'); ?>
		<?php echo $form->textField($model,'end_min',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'end_min'); ?>
	</div>

	<div class="row compactRadioGroup">
		<?php echo $form->labelEx($model,'visibility'); ?>
		<?php echo $form->radioButtonList($model,'visibility', Section::getVisibilityOptions(),array('separator'=> ' 	') ); ?>
		<?php echo $form->error($model,'visibility'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'allow_guest_message'); ?>
        <?php echo $form->checkbox($model,'allow_guest_message'); ?>
        <?php echo $form->error($model,'allow_guest_message'); ?>
    </div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->