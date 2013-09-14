<?php
/* @var $this EventController */
/* @var $model Event */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php //echo $form->textField($model,'start_date'); 
		
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	  		  'name'=>'Event[start_date]',
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
		
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_date'); ?>
		<?php 
			//echo $form->textField($model,'end_date'); 
		
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	  		  'name'=>'Event[end_date]',
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
		<?php echo $form->error($model,'end_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_user_id'); ?>
		<?php echo $form->textField($model,'create_user_id'); ?>
		<?php echo $form->error($model,'create_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
		<?php echo $form->error($model,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_user_id'); ?>
		<?php echo $form->textField($model,'update_user_id'); ?>
		<?php echo $form->error($model,'update_user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->