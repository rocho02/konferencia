<?php
/* @var $this SectionController */
/* @var $data Article */
?>
<div class='view'>
	<div>
	 	<?php echo "file: ". $data->file_name;   ?>
	</div>
	<div>
	 	<?php echo 'Version:' . $data->getCurrentVersion()->version;   ?>
	</div>
	<div>
	 	<?php echo 'Flag:' . $data->getCurrentVersion()->flag;   ?>
	</div>
	<div>
	 	<?php echo CHtml::link( CHtml::encode( Yii::t('app' ,'Write Opinion') ) ,array('opinion/create', 'article'=>$data->id_article ,'section' => $data->sectionArticles[0]->id_section ))   ?>
	 	<?php echo CHtml::link( CHtml::encode( Yii::t('app' ,'Add Judge') ) ,array('section/addjudge', 'article'=>$data->id_article ,'section' => $data->sectionArticles[0]->id_section ))   ?>
	</div>
</div>