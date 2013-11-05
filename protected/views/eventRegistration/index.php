<?php
/* @var $this EventRegistrationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    Yii::t('app','Event') => array('event/view','id'=>$event->id_event),
	'Event Registrations',
);

$this->menu=array(
    array( 'label'=> Yii::t('app','Event') , 'url'=> array('event/view','id'=>$event->id_event) ),
);
?>

<h1><?php echo Yii::t('app','Registered Users') ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array( 'value'=>'$data->user->username', 'name'=>Yii::t('app','Username') ),
        array( 'value'=>'$data->user->name', 'name'=>Yii::t('app','Name') ),
        array( 'value'=>'$data->user->surname', 'name'=>Yii::t('app','Surname') ),
        array( 'value'=>'$data->user->email', 'name'=>Yii::t('app','Email') ),
        /*
        array(
            'class'=>'CButtonColumn',
        ),
         * 
         */
    ),
)); ?>
