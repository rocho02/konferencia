<?php
/* @var $this SectionController */
/* @var $model Section 
 * @var $articles Articles 
 * */

$this->breadcrumbs=array(
	'Sections'=>array('index','event'=>$section->id_event),
	$section->title =>array('view','id'=>$section->id_section),
	'Add Articles'
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'message-form',
	'enableAjaxValidation'=>false,
)); ?>

<table>
<thead>
	<tr>
		<td></td>
		<td>Cikk Cime</td>
	</tr>
</thead>	
<?php
foreach($articles as $article){
	$attached = sizeof($article->sectionArticles ) > 0;
	?>
	<tr>
		<td><?php echo CHtml::checkbox('attached',$attached,array( 'value'=>$article->id_article, 'readonly'=> $attached ? 'readonly' : '')) ?></td>
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