<?php
/* @var $this MessageController */
/* @var $data Message */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel(Yii::t("app", 'Sender'))); ?>:</b>
	<?php echo CHtml::encode($data->getSenderUserName()); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel(Yii::t("app", 'Subject'))); ?>:</b>
	<?php echo  CHtml::link(  CHtml::encode(   $data->subject) , array('read','id'=>$data->id_message)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode( $data->create_time); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel(Yii::t("app", 'Status'))); ?>:</b>
	<?php
		
		$userMessage = $data->userMessages[0];
		if ( $userMessage->status == Message::STATUS_NEW ){
			echo CHtml::encode( Yii::t('app','New') ); 
		}else{
			echo CHtml::encode( Yii::t('app','Read') );
		}  
	?>
	<br />

</div>