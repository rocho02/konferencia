<?php
	/*
		var $opinion Opinion
	 * var $section Section 
	 * */

?>
<?php

	$this->breadcrumbs = array(
		Yii::t('app','Events')=>array('event/index'),
		Yii::t('app','Event')=>array('event/view','id'=>$model->section->id_event),
		Yii::t('app','Section')=>array('section/view','id'=>$model->section->id_section),
		Yii::t('app','Opinions')=>array('event/opinions','id'=>$model->section->id_event),
	);

?>
<style type="text/css">
	
	.op-content{ font-size: 1em;}
	.op-meta span {font-size: 0.8em;}
	.op-meta span.title {font-weight: bold;}
	
</style>
<h1><?php echo Yii::t('app',"Section Article Accept") ?></h1>

<article>
	<header>
		<h2>
			<?php echo $model->opinion->aspects[0]->summary ?>
		</h2>
		<div class="op-meta">
			<div><span class="title"><?php  echo Yii::t('app','Writer') ?>:</span > <?php  echo  $model->opinion->createUserName   ?></div>
			<div><span class="title"><?php  echo Yii::t('app','Created') ?>:</span > <?php  echo date('Y-m-d G:i' ,strtotime($model->opinion->create_time)  ) ?></div>
			<div><span class="title"><?php  echo Yii::t('app','Download article') ?>:</span >   <?php echo CHtml::link( $model->article->file_name , array('article/articleDownload' ,'id_article' =>$model->opinion->id_article , 'id_article_version' =>$model->opinion->id_article_version ),array('target'=>'_blank')) ?> </div>
		</div><br><br>
	</header>
	<section  class='op-content' >
			<?php echo  nl2br( CHtml::encode( $model->opinion->aspects[0]->opinion ) )?>
	</section>
</article>
<br>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-accept-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php 
		echo CHtml::activeHiddenField($model,"id_article");
		echo CHtml::activeHiddenField($model,"id_article_version");
	?>
	<?php if ( !$model->article->isAccepted() ){ ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app','Mark Article Weak Accepted'),array('name'=>'EventOpinionAcceptForm[_accept]') ); ?>
		<?php echo CHtml::submitButton(Yii::t('app','Mark Article Weak Rejected'),array('name'=>'EventOpinionAcceptForm[_reject]') ); ?>
	</div>
<?php }else{
    
    $acceptedVersions = $model->article->acceptedVersions;
    $acceptMode = $acceptedVersions[0]->flag;
    $humanreadableMode = '';
    switch($acceptMode){
        case ArticleVersion::FLAG_ACCEPTED: $humanreadableMode = Yii::t('app','Accepted'); break;
        case ArticleVersion::FLAG_WEAK_ACCEPTED: $humanreadableMode = Yii::t('app','Weak Accepted'); break;
    }
    print "<b>".$humanreadableMode."</b>";
}

?>
<?php $this->endWidget(); ?>