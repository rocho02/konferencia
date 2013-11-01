<?php
	$this->pageTitle=Yii::app()->name . ' - Add User To Project';
	$this->breadcrumbs=array(
		$model->event->title=>array('view','id'=>$model->event->id_event),'Add User',
	);
	$this->menu=array(
		array('label'=>Yii::t("app",'Back To Event'), 'url'=>array('view','id'=>$model->event->id_event)),
	);
?>
<h1>Felhasználó hozzárendelése konferenciához</h1>

<h4><?php echo Yii::t('app', 'Konferencia részletei') ?></h4>
<?php

    $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model->event,
    'attributes'=>array(
        'title',             // title attribute (in plain text)
        'start_date',             // title attribute (in plain text)
        'end_date',             // title attribute (in plain text)
    ),
));

?>

<?php if(Yii::app()->user->hasFlash('success')):?>
	<div class="successMessage">
		<?php echo Yii::app()->user->getFlash('success'); ?>
	</div>
<?php endif; ?>
<br/>
<h4><?php echo Yii::t('app', 'Felhasználó hozzárendelése') ?></h4>
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
<br/>
<h4><?php echo Yii::t('app','Event administrators') ?></h4>
    
<?php
$dpUsers = new CArrayDataProvider( $users, array('id' => 'dpUsers', 'keyField'=>'id')  );

$form=$this->beginWidget('CActiveForm',array(
    'id'=>'unassign-form',
    'enableAjaxValidation'=>false,
));
    ?>
    <input type='hidden' name="EventUnAssignForm[id_user]" >
    <?php
    
 $this->endWidget();  

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dpUsers,
    'columns'=>array(
        'username',
        'name',
        'surname',
        array(            // display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
             'buttons' => array(
                'delete' => array(                      
                   'url'=>'$data->id',
                   'visible'=>'true',
                   'options'=>array('class'=>'viewbtns'),
                   'click'=>"js: function(){  $('#unassign-form').find(\"input[type='hidden']\").val( $(this).attr('href')); $('#unassign-form').submit();  return false; }",
                )
        ),
            
        ),
    )
));

?>

