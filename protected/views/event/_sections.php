<?php foreach($eventSections as $eventSection):
?>
<div class="event_section">
	<div class="event_title">
		<?php echo Yii::t('app','Title').":&nbsp" . CHtml::link(  CHtml::encode($eventSection -> title), array('section/view','id' => $eventSection->id_section) ); ?>
	</div>
	<div class="event_create_time">
		Létrehozás ideje: <?php echo date('F j, Y \a\t h:i a', strtotime($eventSection -> create_time)); ?>
	</div>
	<div class="event_created_user">
		<?php echo Yii::t('app','Create User').":&nbsp" . CHtml::encode($eventSection -> createUserName); ?>
	</div>
	<div class="event_start_time">
		<?php echo Yii::t('app','Start:')."&nbsp" . CHtml::encode($eventSection -> start_time); ?>
	</div>
	<div class="event_end_time">	
		<?php echo Yii::t('app','End:')."&nbsp" . CHtml::encode($eventSection -> end_time ); ?>
	</div>
	<div class="visibility">
		<?php 
		
		$visiblities = Section::getVisiblityOptions();
		$visibilityName = $visiblities[$eventSection -> visibility]; 
		echo Yii::t('app','Visibility:')."&nbsp" . CHtml::encode( $visibilityName ); ?>
	</div>
	<hr>
</div><!-- comment -->
<?php endforeach; ?>