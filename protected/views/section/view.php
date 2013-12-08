<?php
/* @var $this SectionController */
/* @var $model Section */

$user = Yii::app()->user;

$event_admin = $model->event->isUserInEvent($user);
$section_admin = $model->isUserInSection($user);
$_admin = Yii::app()->user->checkAccess('admin');
$section_admin_weak = $model->allowCurrentUser(Section::ROLE_SECTION_ADMIN_WEAK);

$admin = $event_admin || $section_admin || $_admin;

$allow_guest_message = $model->allow_guest_message;

$this->breadcrumbs=array(
	Yii::t('app','Events')=>array('event/index' ),
	$model->event->title=>array('event/view','id'=>$model->id_event ),
	//Yii::t('app','Sections')=>array('section/index', 'event'=> $model->id_event ),
	$model->title,
);

$this->menu=array(
	//array('label'=>Yii::t('app', 'List Section' ), 'url'=>array('index','event'=>$model->id_event)),
	//array('label'=>'Create Section', 'url'=>array('create')),
	array('label'=>Yii::t('app','Update Section'), 'url'=>array('update', 'id'=>$model->id_section),'visible'=>$admin),
	//array('label'=>Yii::t('app','Delete Section'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_section),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Section', 'url'=>array('admin')),
	array('label'=>Yii::t('app','Attach article'), 'url'=>array('addArticle', 'section'=>$model->id_section)),
	array('label'=>Yii::t('app','Add User To section'), 'url'=>array('adduser', 'id'=>$model->id_section),'visible'=>$admin),
	array('label'=>Yii::t('app','Message To Admin'), 'url'=>array('message/sectionAdminMessage', 'section'=>$model->id_section),'visible'=>$allow_guest_message),
	array('label'=>Yii::t('app','Export PDF'), 'url'=>array('pdfview', 'id'=>$model->id_section),'visible'=>true,'linkOptions'=>array("target" =>"_blank")),
	array('label'=>Yii::t("app",'Article Opinions'), 'url'=>array('section/opinions','id'=>$model->id_section),'visible'=>$section_admin_weak),
);
?>
<?php
if ( isset($exportDate) ){
    echo "<div style='text-align: right;' >".Yii::app()->name."</div>";
}
?>
<h1>Szekció adatai</h1>
<?php 
    if ( isset($exportDate) ){
        echo "Exportálás dátuma:" .  Yii::app()->dateFormatter->formatDateTime(time(), 'medium', 'medium');
        echo "<br/><br/>";
    }
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'description',
		array(
            'label' =>Yii::t('app','Allow guest message'),
            'type' => 'raw',
            'value' => "<input onclick='javascript: return false;' type='checkbox' " . ( $model->allow_guest_message == 1 ? "checked='checked'" : "" ) ." >" 
        ),
		'start_time',
		'end_time',
		'humanReadableVisibility',
	),
)); ?>
<br><br>
<h2><?php echo Yii::t('app','Administrators') ?></h2>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dpAdmin,
    'columns'=>array(
        'username',
        'name',
        'surname',
    )
));

?>
<br>
<br>
<h3>Csatolt fájlok</h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$articleDataProvider,
	'itemView'=>'_view_article',
)); ?>

