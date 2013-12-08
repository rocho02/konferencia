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

<h4><?php echo Yii::t('app', 'Szekcio részletei') ?></h4>
<?php

    $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model->section,
    'attributes'=>array(
        'title',             // title attribute (in plain text)
        'start_date',             // title attribute (in plain text)
        'end_date',             // title attribute (in plain text)
    ),
));

?>
<br />
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
<br/>
<h4><?php echo Yii::t('app','Section administrators') ?></h4>
    
<?php
$dpUsers = new CArrayDataProvider( $users, array('id' => 'dpUsers', 'keyField'=>'id')  );

$form=$this->beginWidget('CActiveForm',array(
    'id'=>'unassign-form',
    'enableAjaxValidation'=>false,
));
    ?>
    <input type='hidden' name="SectionUserUnassignForm[id_user]" >
    <?php
    
 $this->endWidget();  



$dpUsers = new CArrayDataProvider( $assignments, array('id' => 'dpUsers', 'keyField'=>'id_user')  );

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dpUsers,
    'columns'=>array(
        array(
         'name'=> Yii::t('app','Username'),
         'value'=>'$data->user->username',
         ),
        array(
         'name'=> Yii::t('app','Role'),
         'value'=>'$data->role',
         ),
        array(            // display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
             'buttons' => array(
                'delete' => array(                      
                   'url'=>'$data->id_user',
                   'visible'=>'true',
                   'options'=>array('class'=>'viewbtns'),
                   'click'=>"js: function(){  $('#unassign-form').find(\"input[type='hidden']\").val( $(this).attr('href')); $('#unassign-form').submit();  return false; }",
                )
        ),
            
        ),
    )
));

?>