<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->id_article,
);

$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index')),
	array('label'=>'Create Article', 'url'=>array('articleVersion/create')),
	//array('label'=>'Update Article', 'url'=>array('update', 'id'=>$model->id_article)),
	//array('label'=>'Delete Article', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_article),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Article', 'url'=>array('admin')),
	array('label'=>'Upload New Version', 'url'=>array('articleVersion/create','article'=>$model->id_article)),
);
?>

<h1>View Article #<?php echo $model->id_article; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_article',
		'file_name',
		'create_time',
		'createUserName',
	),
)); ?>
<br>
<h3>Attached to sections</h3>
<?php /* echo "Attached to sections: " . sizeof( $model->sectionArticles ) ; */?>
<?php 
/*
	$this->renderPartial('_view_sections',array(
		'model'=>$model->sectionArticles,
	));
*/
?>
<?php
/*
 */
 $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>new CArrayDataProvider($model->sectionArticles, array('keyField'=>'id_section_article' ,'id' =>'clw_sections')),
	'itemView'=>'_view_sections',
));
?>


<br>
<h2> <?php echo Yii::t('app','Versions') ?></h2>
<?php $this->renderPartial('_versions',array(
'articleVersions'=>$model->articleVersions,
)); ?>