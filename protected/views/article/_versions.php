<?php foreach($articleVersions as $articleVersion):
?>
<div class="article_version">
	<div class="version">
		<?php echo Yii::t('app','Version').":&nbsp" . CHtml::encode($articleVersion -> version); ?>
	</div>
	<div class="version">
		<?php echo Yii::t('app','Uploaded file').":&nbsp" . CHtml::encode($articleVersion -> original_file_name); ?>
	</div>
	<div class="time">
		uploaded: <?php echo date('F j, Y \a\t h:i a', strtotime($articleVersion -> create_time)); ?>
	</div>
	<div class="status_text">
		<?php echo Yii::t('app','Status:')."&nbsp" . CHtml::encode($articleVersion -> statusText); ?>
	</div>
	<div class="uploaded_by">
		<?php echo Yii::t('app','Uploaded by').":&nbsp" . CHtml::encode($articleVersion -> createUserName); ?>
	</div>
	<hr>
</div><!-- comment -->
<?php endforeach; ?>