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
	'Create',
);
	
}

$this->menu=array(
	//array('label'=>'List Opinion', 'url'=>array('index')),
	//array('label'=>'Manage Opinion', 'url'=>array('admin')),
);
?>

<h1>Vélemény írása</h1>
<br />
<?php 
    if ( isset($role) && $role == Permissions::ROLE_ARTICLE_JUDGE ){
       echo "Writer:";
       echo $article->writer;
       echo "<br>"; 
    }
    echo Yii::t('app','Title') . ":&nbsp;";
       echo $article->title;
       echo "<br>";
 ?>
Cikk:
<?php  echo CHtml::link( $article->file_name , array('article/articleDownload' ,'id_article' =>$article->id_article , 'id_article_version' =>$article->getCurrentVersion()->id_article_version ),array('target'=>'_blank')) ?>
<br />
<br />
<?php echo $this->renderPartial('_form', array('model'=>$model,'aspect'=>$aspect,)); ?>