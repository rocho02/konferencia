<?php
/* @var $this SectionController */
/* @var $model Section */

$this->breadcrumbs=array(
	'Sections'=>array('index','event'=>$section->id_event),
	$section->title =>array('view','id'=>$section->id_section),
	'Add Articles'
);