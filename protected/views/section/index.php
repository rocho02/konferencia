<?php
/* @var $this SectionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sections',
);

$this->menu=array(
	array('label'=> Yii::t('app','Event') , 'url'=>array('event/view','id'=>$event->id_event)),
	//array('label'=>'Create Section', 'url'=>array('create')),
	//array('label'=>'Manage Section', 'url'=>array('admin')),
);
?>

<h1>Konferencia szekcióinak listája</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
