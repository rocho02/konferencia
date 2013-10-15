<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t("app",'List Article'), 'url'=>array('index')),
	array('label'=>Yii::t("app",'Manage Article'), 'url'=>array('admin')),
);
?>

<h1>Cikk hozzáadása</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>