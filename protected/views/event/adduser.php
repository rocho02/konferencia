<?php
	$this->pageTitle=Yii::app()->name . ' - Add User To Project';
	$this->breadcrumbs=array(
		$model->event->title=>array('view','id'=>$model->event->id_event),'Add User',
	);
	$this->menu=array(
		array('label'=>Yii::t("app",'Back To Event'), 'url'=>array('view','id'=>$model->event->id_event)),
	);
?>
<h1>Konferencia szervező hozzárendelése a(z) <?php echo $model->event->title; ?> konferenciához</h1>
<?php if(Yii::app()->user->hasFlash('success')):?>
	<div class="successMessage">
		<?php echo Yii::app()->user->getFlash('success'); ?>
	</div>
<?php endif; ?>
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm'); ?>
	<p class="note">Fields with <span class="required">*</span> are	required.</p>
	<div class="row">
		<?php echo $form->labelEx($model,Yii::t("app",'Username')); ?>
		<?php
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name'=>'username',
				'source'=>$model->createUsernameList(),
				'model'=>$model,
				'attribute'=>'username',
				'options'=>array(
				'minLength'=>'2',
			),
			'htmlOptions'=>array('style'=>'height:20px;'),
			));
		?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php echo $form->dropDownList($model,'role',Event::getUserRoleOptions()); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t("app",'Add')); ?>
	</div>
	<?php $this->endWidget(); ?>
</div>