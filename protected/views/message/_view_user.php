<?php
/* @var $this MessageController */
/* @var $data UserMessage */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel( Yii::t('app','Username'))); ?>:</b>
	<?php echo CHtml::encode($data->recepient->username); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel( Yii::t('app','Status'))); ?>:</b>
	<?php
		if ( $data->status == Message::STATUS_NEW ){
			echo CHtml::encode( Yii::t('app','New') ); 
		}else{
			echo CHtml::encode( Yii::t('app','Read') );
		}  
	?>
	<br />

</div>