<?php
/* @var $this ArticleController */
/* @var $data SectionArticle */
?>
<div class="view">

	<b><?php echo CHtml::encode($data->section->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::link( CHtml::encode($data->section->title), array('view', 'id'=>$data->section->id_section)); ?>
	<br />

</div>