<?php
/* @var $this SectionController */
/* @var $model SectionAddArticleForm 
 * */

$this->breadcrumbs=array(
	'Sections'=>array('index','event'=>$model->section->id_event),
	 $model->section->title =>array('view','id'=>$model->section->id_section),
	'Add Articles'
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'addarticle-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		)
)); ?>

<table>
<thead>
	<tr>
		<td></td>
		<td>Cikk címe</td>
	</tr>
</thead>	
<?php echo $form->labelEx($model,'selectedArticles'); ?>
<?php echo $form->error($model,'selectedArticles'); ?>
<?php

foreach($model->articles as $article){
	$attached = sizeof($article->sectionArticles ) > 0;
	?>
	<tr>
		<td><?php echo CHtml::checkbox('SectionAddArticleForm[selectedArticles][]',$attached,array( 'id'=>'chk_article_'.$article->id_article, 'value'=>$article->id_article, 'disabled'=> $attached ? 'disabled' : '')) ?></td>
		<td><?php echo $article->file_name ?></td>
	</tr>
	<?php
}

?>
</table>
<div class="row buttons">
		<?php echo CHtml::submitButton('attach selected items'); ?>
	</div>
<?php $this->endWidget(); ?>