<?php
/* @var $this OpinionController */
/* @var $model Opinion */

$this->breadcrumbs=array(
	Yii::t('app','Events')=>array('event/index'),
	Yii::t('app','Event')=>array('event/view','id'=>$section->id_event),
	Yii::t('app','Sections')=>array('section/index','event'=>$section->id_event),
	Yii::t('app','Section')=>array('section/view','id'=>$section->id_section),
	Yii::t('app','Opinions')=>array('opinion/index','article'=>$model->id_article,'section'=>$section->id_section),
	$model->id_opinion,
	
);

$this->menu=array(
	// array('label'=>'List Opinion', 'url'=>array('index')),
	// array('label'=>'Create Opinion', 'url'=>array('create')),
	// array('label'=>'Update Opinion', 'url'=>array('update', 'id'=>$model->id_opinion)),
	// array('label'=>'Delete Opinion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_opinion),'confirm'=>'Are you sure you want to delete this item?')),
	// array('label'=>'Manage Opinion', 'url'=>array('admin')),
);
?>

<h1><?php  echo Yii::t('app','Opinion') ?></h1>
<br />
<h2><?php echo Yii::t('app', 'Bírálat tárgya') .": ".  CHtml::encode($model->aspects[0]->summary); ?></h2>
<br />
<div>
	<div>
		<?php echo Yii::t('app','Rating:') ?>
	</div>
	
	<?php  $this->widget('CStarRating',array('model'=> $model->aspects[0], 'attribute' => 'rating' )) ; ?>
	<div style="clear: both;"></div>
</div>
<br />
<div class="" style=' border: 1px solid #e2e2e2; padding: 10px 5px; width: 100%; min-height: 600px;'><?php echo nl2br(CHtml::encode( $model->aspects[0]->opinion )); ?></div>
