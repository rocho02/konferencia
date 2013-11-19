<?php

$this->pageTitle=Yii::app()->name . ' - Add Judge To Article';

$this->breadcrumbs=array(
	Yii::t('app','Events')=>array('event/index' ),
	Yii::t('app','Event')=>array('event/view','id'=>$section->id_event ),
	//Yii::t('app','Sections')=>array('section/index', 'event'=> $section->id_event ),
	Yii::t('app','Section')=>array('section/view', 'id'=> $section->id_section ),
	Yii::t('app','Add Judge')
);

	$this->menu=array(
		array('label'=>Yii::t("app",'Back To Section'), 'url'=>array( 'view','id'=>$section->id_section ) ),
	);
?>
<br />
<h1>Bíráló hozzárendelése cikkhez</h1>
<?php if(Yii::app()->user->hasFlash('success')):?>
	<div class="successMessage">
		<?php echo Yii::app()->user->getFlash('success'); ?>
	</div>
<?php endif; ?>

<h4><?php echo Yii::t('app', 'Cikk részletei') ?></h4>
<?php

    $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model->article,
    'attributes'=>array(
        'writer',
        'title',
        'file_name',             // title attribute (in plain text)
    ),
));

?>
<br />
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
		<?php echo $form->dropDownList($model,'role',Article::getUserRoleOptions()); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t("app",'Add')); ?>
	</div>
	<?php $this->endWidget(); ?>
</div>
<br/>
<h4><?php echo Yii::t('app','Article Judges') ?></h4>
    
<?php
$dpUsers = new CArrayDataProvider( $assignments, array('id' => 'dpUsers', 'keyField'=>'id_user')  );

$form=$this->beginWidget('CActiveForm',array(
    'id'=>'unassign-form',
    'enableAjaxValidation'=>false,
));
    ?>
    <input type='hidden' name="ArticleUserUnassignForm[id_user]" >
    <?php
    
 $this->endWidget();  

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