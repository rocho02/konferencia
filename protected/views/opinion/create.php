<?php
/* @var $this OpinionController */
/* @var $model Opinion */

$this->breadcrumbs=array(
	Yii::t('app','Events')=>array('event/index'),
	Yii::t('app','Event')=>array('event/view','id'=>$section->id_event),
	Yii::t('app','Sections')=>array('section/index','event'=>$section->id_event),
	Yii::t('app','Section')=>array('section/view','id'=>$section->id_section),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Opinion', 'url'=>array('index')),
	//array('label'=>'Manage Opinion', 'url'=>array('admin')),
);
?>

<h1>Create Opinion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'aspect'=>$aspect,)); ?>