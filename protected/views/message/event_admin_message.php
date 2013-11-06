<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
    Yii::t('app','Event')=>array('event/view','id'=> $event->id_event),
    Yii::t('app','Message To Admin'),
);

$this->menu=array(
    //array('label'=>Yii::t("app",'Sent Messages'), 'url'=>array('index'),'visible'=>true),
    //array('label'=>Yii::t("app",'Incoming Messages'), 'url'=>array('/message/incoming')),
);
?>

<h1>Üzenet írása</h1>

<?php echo $this->renderPartial('event_admin_message_form', array('model'=>$model)); ?>