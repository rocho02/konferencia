<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);


if( Yii::app()->user->checkAccess('createUser' )  )
 print "user has operation: createUser";

if( Yii::app()->user->checkAccess('updateUser' )  )
 print "user has operation:  updateUser";


if( Yii::app()->user->checkAccess('updateAndDeleteUser' )  )
 print "user has operation:  updateAndDeleteUser";
else
 print "user has not operation:  updateAndDeleteUser";
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
This is the view content for action "<?php echo $this->action->id; ?>".
The action belongs to the controller "<?php echo get_class($this); ?>"
in the "<?php echo $this->module->id; ?>" module.
</p>
<p>
You may customize this page by editing <tt><?php echo __FILE__; ?></tt>
</p>




xxxxxx

