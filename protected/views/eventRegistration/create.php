<?php
/* @var $this EventRegistrationController */
/* @var $model EventRegistration */

$this->breadcrumbs=array(
	Yii::t('app' ,'Event')=>array('event/create', 'id'=>$event->id_event),
	Yii::t('app','Registration'),
);

$this->menu=array(
	//array('label'=>'List EventRegistration', 'url'=>array('index')),
	//array('label'=>'Manage EventRegistration', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Registration') ?></h1>
<h3><?php echo ( Yii::t('app','Event') .': '.$event->title)  ?></h3>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'eventUserForm'=>$eventUserForm )); ?>