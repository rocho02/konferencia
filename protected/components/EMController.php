<?php
/**
 * base Event Management Controller
 * */
class EMController extends Controller
{
	
	
	function isEventAdmin($event){
		return  Yii::app()->user->checkAccess( Event::ROLE_EVENT_ADMIN ,	array('event'=>$event));
	}
	
	function checkAccessEventAdmin($event){
		if( ! $this->isEventAdmin($event )  ){
			throw new CHttpException(403,'You are not authorized to performthis action.');
		}
	}
	
}
	