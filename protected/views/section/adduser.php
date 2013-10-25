<?php
	$this->pageTitle=Yii::app()->name . ' - Add User To Section';
	$this->breadcrumbs=array(
		Yii::t('app','Events')=>array('event/index','id'=>$model->event->id_event),
		Yii::t('app','Event')=>array('view','id'=>$model->event->id_event),
		Yii::t('app','Section')=>array('section/view','id'=>$model->section->id_section),
		'Add User',
	);
	$this->menu=array(
		array('label'=>Yii::t("app",'Back To Section'), 'url'=>array('view','id'=>$model->section->id_section)),
	);
?>
<h1>Felhasználó  hozzárendelése szekcióhoz </h1>
<h2>Szekció: <?php echo $model->section->title; ?> </h2>
<?php if(Yii::app()->user->hasFlash('success')):?>
	<div class="successMessage">
		<?php echo Yii::app()->user->getFlash('success'); ?>
	</div>
<?php endif; ?>
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm'); ?>
	<p class="note">A <span class="required">*</span> - al jelölt mezők kötelezőek</p>
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
		<?php echo $form->dropDownList($model,'role',Section::getUserRoleOptions()); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t("app",'Add')); ?>
	</div>
	<?php $this->endWidget(); ?>
</div>