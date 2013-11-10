<h1><?php echo Yii::t('app', 'Invitations') ?></h1><br><br>
<h2><?php echo Yii::t('app', 'Can be Invited') ?></h2>

<div class="form">
<?php 
$this->breadcrumbs=array(
    Yii::t('app','Events')=>array('/event/index' ),
    Yii::t('app','Event')=>array('/event/view','id'=> $event->id_event),
    Yii::t('app','Invitation')
);


$form=$this->beginWidget('CActiveForm', array(
    'id'=>'event-form',
    'enableAjaxValidation'=>false,
)); 
 echo $form->errorSummary($model);  
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dpUsers,
    'selectableRows'=>2,
    'columns'=>array(
        array(            // display a column with "view", "update" and "delete" buttons
            'class'=>'CCheckBoxColumn',
            'selectableRows'=>null,
            'checkBoxHtmlOptions'=>array( "name" =>'InviteForm[invite][]'),
            'checked'=>'$data->invited',
        ),
        'user.username',
        'user.name',
        'user.surname',
    )
));
?>
<input type='hidden' name="InviteForm[action]" value="invite" >
<div class="row buttons">
        <?php echo CHtml::submitButton( Yii::t("app", 'Invite')  ); ?>
    </div>
<?php
 $this->endWidget(); 
?>
</div>
<br><br>
<h2><?php echo Yii::t('app', 'Already Invited') ?></h2>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dpInvited,
    'columns'=>array(
        'username',
        'name',
        'surname',
    )
));

?>