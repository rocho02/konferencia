<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$is_admin = Yii::app()->user->checkAccess('admin');

$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>Yii::t("app",'CreateUser'), 'url'=>array('create'),'visible'=>$is_admin),
	array('label'=>Yii::t("app",'Manage User'), 'url'=>array('admin'),'visible'=>$is_admin),
);
?>

<h1>Felhasználók listázása</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
