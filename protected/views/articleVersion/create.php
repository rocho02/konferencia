<?php
/* @var $this ArticleVersionController */
/* @var $article Article */
/* @var $articleVersion ArticleVersion */

$this->breadcrumbs=array(
	'Article Versions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ArticleVersion', 'url'=>array('article/view','id'=>$article->id_article), 'visible'=>!$article->isNewRecord),
	//array('label'=>'Manage ArticleVersion', 'url'=>array('admin')),
);
?>
<?php if ( $article->isNewRecord)
	echo "<h1>Cikk feltöltése</h1>";
else {
	echo "<h1>Létező cikk új verziójának feltöltése</h1>";
}
?>


<?php echo $this->renderPartial('_form', array('article'=>$article, 'articleVersion' => $articleVersion)); ?>