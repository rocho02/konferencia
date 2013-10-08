<?php foreach($eventSections as $eventSection):
?>
<div class="article_version">
	<div class="version">
		<?php echo Yii::t('app','Title').":&nbsp" . CHtml::encode($eventSection -> title); ?>
	</div>
	<div class="time">
		Created: <?php echo date('F j, Y \a\t h:i a', strtotime($eventSection -> create_time)); ?>
	</div>
	<div class="created_by">
		<?php echo Yii::t('app','Create User').":&nbsp" . CHtml::encode($eventSection -> createUserName); ?>
	</div>
	<div class="start_time">
		<?php echo Yii::t('app','Start:')."&nbsp" . CHtml::encode($eventSection -> start_time); ?>
	</div>
	<div class="end_time">
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