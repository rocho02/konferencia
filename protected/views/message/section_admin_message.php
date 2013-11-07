<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $section Section */
$this->breadcrumbs=array(
    Yii::t('app','Event')=>array('event/view','id'=> $section->id_event),
    Yii::t('app','Section')=>array('section/view','id'=> $section->id_section),
    Yii::t('app','Message To Admin'),
);

$this->menu=array(
    //array('label'=>Yii::t("app",'Sent Messages'), 'url'=>array('index'),'visible'=>true),
    //array('label'=>Yii::t("app",'Incoming Messages'), 'url'=>array('/message/incoming')),
);
?>

<h1>Üzenet írása</h1>

<?php echo $this->renderPartial('section_admin_message_form', array('model'=>$model)); ?>