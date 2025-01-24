<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\AlertNotification;
use App\Models\UserNotification;
use DB;
use URL;
use Mail;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AlertController extends Controller{	
	public function receiveNotification($user_id){	
	   $last_date = date('Y-m-d', strtotime('-30 days'));	
		$userNotification = UserNotification::join('alert_notifications', 'alert_notifications.id', '=', 'user_notifications.alert_notification_id')
						->where('user_notifications.user_id',$user_id)->where('alert_notifications.created_at','>=',$last_date)
						->select('alert_notifications.*','user_notifications.*')->orderBy('user_notifications.id','desc')->get();
	  if(sizeof($userNotification) > 0){
		$data = array("message"=>"success","data"=>$userNotification);	
	  } else {
		$data = array("message"=>"success","data"=>'empty');	
	  }		  
		return response($data, Response::HTTP_OK);
	}
}