<?php
/* @var $this OpinionController */
/* @var $model Opinion */

if ( $scenario == 'create'){
$this->breadcrumbs=array(
    Yii::t('app','Events')=>array('event/index'),
    Yii::t('app','Event')=>array('event/view','id'=>$section->id_event),
    //Yii::t('app','Sections')=>array('section/index','event'=>$section->id_event),
    Yii::t('app','Section')=>array('section/view','id'=>$section->id_section),
    'Create',
);
}else if ( $scenario == 'judge'){
    
    $this->breadcrumbs=array(
    Yii::t('app','Articles')=>array('article/index'),
    Yii::t('app' ,'Update'),
);
    
}
$this->menu=array(
	// array('label'=>'List Opinion', 'url'=>array('index')),
	// array('label'=>'Create Opinion', 'url'=>array('create')),
	// array('label'=>'View Opinion', 'url'=>array('view', 'id'=>$model->id_opinion)),
	// array('label'=>'Manage Opinion', 'url'=>array('admin')),
);
?>

<h1>Update Opinion <?php echo $model->id_opinion; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'aspect'=>$aspect,)); ?>