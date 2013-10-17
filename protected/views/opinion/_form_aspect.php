<div class="row">
	<?php echo $form->labelEx($model,'summary'); ?>
	<?php echo $form->textField($model,'summary',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'summary'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'opinion'); ?>
	<?php echo $form->textArea($model,'opinion',array("cols"=>50 , "rows"=>10)); ?>
	<?php echo $form->error($model,'opinion'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'rating'); ?>
	<?php /* echo $form->textField($model,'rating'); */?>
		<div>
		  <?php   $this->widget('CStarRating',array('model'=> $model, 'attribute' => 'rating')) ; ?>
		  <div style="clear: both;"></div>
		</div>
	<?php echo $form->error($model,'rating'); ?>
</div>
