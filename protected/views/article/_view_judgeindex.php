<?php
/* @var $this ArticleController */
/* @var $data Article */
?>

<?php

?>

<div class="view">
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::encode($data->title); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_name')); ?>:</b>
	<?php  echo CHtml::link( $data->file_name , array('article/articleDownload' ,'id_article' =>$data->id_article , 'id_article_version' =>$data->getCurrentVersion()->id_article_version ),array('target'=>'_blank')) ?>
	<br />

    <?php /*?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createUserName')); ?>:</b>
	<?php echo CHtml::encode($data->createUserName); ?>
	<br />

<?php */?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('currentVersionNumber')); ?>:</b>
	<?php echo CHtml::encode($data->currentVersionNumber); ?>
	<br />	

	<?php
	   if (isset($data->opinions) &&  sizeof($data->opinions ) > 0  ){
	       $opinion = $data->opinions[0];
	      echo CHtml::link(Yii::t( 'app','Edit Opinion' ), array('opinion/judgeupdate','id'=>$opinion->id_opinion) ); 
	   } 
       else{
           echo CHtml::link(Yii::t( 'app','Write Opinion' ), array('opinion/judgeCreate','article'=>$data->id_article) );
       }
	  ?>
	<br />

</div>