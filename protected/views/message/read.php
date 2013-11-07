<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->id_message,
);

$this->menu=array(
	array('label'=>Yii::t("app",'Sent Message'), 'url'=>array('index')),
	array('label'=>Yii::t("app",'Create Message'), 'url'=>array('create')),
	array('label'=>Yii::t("app",'Incoming Messages'), 'url'=>array('incoming')),
	array('label'=>Yii::t('app','Delete Message'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_message),'confirm'=>'Biztosan törli ezt az üzenetet?')),
);
?>

<h1><?php echo Yii::t('app','Read Message') ?></h1>

<span style="display: inline-block; width: 120px;">
<b><?php echo CHtml::encode($model->getAttributeLabel('Küldő')); ?>:</b>
</span>
<span style=" display: inline-block; border: 1px solid black; width: 400px; padding: 3px; height:20px; line-height: 20px; vertical-align: middle;">
<?php echo CHtml::encode($model->getSenderUserName()); ?>
</span>
<br />

<span style="display: inline-block; width: 120px;">	
<b><?php echo CHtml::encode($model->getAttributeLabel('Tárgy')); ?>:</b>
</span>
<span style="margin-top: 5px; display: inline-block; border: 1px solid black; width: 400px; padding: 3px; height:20px; line-height: 20px; vertical-align: middle;">
<?php echo   CHtml::encode(   $model->subject) ; ?>
</span>
<br />
<?php
    $sections = $model->attachedSections;
    if (sizeof($sections) > 0){
        echo "<br />";
        foreach($sections as $object){
           echo CHtml::link('Hivatkozott Szekció' , array('section/view','id'=>$object->id_object) );
        }
    } 
  ?>
<?php
    $events = $model->attachedEvents;
    if (sizeof($events) > 0){
        echo "<br />";
        foreach($events as $object){
           echo CHtml::link('Hivatkozott Konverencia' , array('event/view','id'=>$object->id_object) );
        }
    } 
  ?>

<br />
<?php echo   CHtml::activeTextarea( $model ,'body' ,array('cols'=>65,'rows'=>10, 'readonly'=>'readonly', 'style'=>'margin-top: 20px;' )  ) ; ?>
