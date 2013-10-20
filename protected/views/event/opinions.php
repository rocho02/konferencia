<?php
	$this->breadcrumbs = array(
	Yii::t('app',"Event"  ) => array("event/view" , 'id'=>$event->id_event) ,
	Yii::t('app','Opinions') => array("event/opinion" , 'id'=>$event->id_event) ,
	);
 ?>
<h1>Konferencia</h1>
<h2><?php  echo $event->title ?></h2>
<h3>Bírálatok </h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view_opinion',
)); ?>
