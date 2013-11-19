<?php
/* @var $this SectionController */
/* @var $data Article */
?>
<div class='view'>
     <div>
        <?php echo "Szerző: ". $data->writer;   ?>
    </div>
     <div>
        <?php echo "Cím: ". $data->title;   ?>
    </div>
	<div>
	 	<?php echo "Fájl: ". $data->file_name;   ?>
	</div>
	<div>
	 	<?php echo 'Verzió:' . $data->getCurrentVersion()->version;   ?>
	</div>
	<div>
	 	<?php echo 'Flag:' . $data->getCurrentVersion()->flag;   ?>
	</div>
	<div>
	 	<?php echo CHtml::link( CHtml::encode( Yii::t('app' ,'Write Opinion') ) ,array('opinion/create', 'article'=>$data->id_article ,'section' => $data->sectionArticles[0]->id_section ))   ?>
	 	<?php echo CHtml::link( CHtml::encode( Yii::t('app' ,'Add Judge') ) ,array('section/addjudge', 'article'=>$data->id_article ,'section' => $data->sectionArticles[0]->id_section ))   ?>
	 	<?php echo CHtml::link( Yii::t('app' , 'Download') , array('article/articleDownload' ,'id_article' =>$data->id_article , 'id_article_version' =>$data->getCurrentVersion()->id_article_version ),array('target'=>'_blank')) ?>
	</div>
</div>