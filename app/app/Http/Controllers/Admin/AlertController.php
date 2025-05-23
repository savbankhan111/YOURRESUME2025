<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserValidation;
use App\User;
use App\Models\School;
use App\Models\Student;
use App\Models\Professional;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AlertNotification;
use App\Models\UserNotification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Mail;
use Auth;

class AlertController extends Controller{
	
	public function sendNotification(){
		return view("admin/alert/send_notification");
    }
	
	public function putSendNotification(Request $request){
		$request->validate(['send_to'=>'required','header'=> 'required','description'=>'required']); 
		$cuser_id = Auth::user()->id;
		$students= $professional= array();
	  if($request->send_to == 'all'){
		  $students= Student::select('user_id')->get();
		  $professional = Professional::select('user_id')->get();		
	  } elseif($request->send_to == 'student'){	
		  $students= Student::select('user_id')->whereNotNull('school_id')->get();  
	  } elseif($request->send_to == 'non-student'){	
		  $students= Student::select('user_id')->whereNull('school_id')->get();  
	  } else{		
		  $professional = Professional::select('user_id')->get();
	  } 
			$header = trim($request['header']); 
			$description=trim($request['description']);
			$alert_notf = AlertNotification::create([
					"notification_type"=>'admin',
					"header" =>$header,
					"description"=>$description,
					"created_by"=>$cuser_id
				]);	
		if(sizeof($students) > 0){		 
		 foreach($students as $std){	
			UserNotification::create([
				"user_id" => $std->user_id,
				"alert_notification_id"=> $alert_notf->id,			
			]);
		  if(!empty($std->user->fcm_token)){
			$token = $std->user->fcm_token;	
			$AlertNotification = AlertNotification::where('id',$alert_notf->id)->first();
				$mess = array (
						'registration_ids' => array ($token),
						'data' => $AlertNotification
					  );
		   $this->sendGCM($mess, $description, $token);
		  }
		 }
		}		
		if(sizeof($professional) > 0){
		 foreach($professional as $std){	
			UserNotification::create([
				"user_id" => $std->user_id,
				"alert_notification_id"=> $alert_notf->id,			
			]);
			if(!empty($std->user->fcm_token)){
			 $token = $std->user->fcm_token;	
			 $AlertNotification = AlertNotification::where('id',$alert_notf->id)->first();
				$mess = array (
						  'registration_ids' => array ($token),
						  'data' => $AlertNotification
						 );
			 $this->sendGCM($mess, $description, $token);
			}
		 }
		}	
	  return redirect()->back()->with("success","Notification sent successfully.");
    }	
	
   	public function sentNotification(){
	  //$cuser_id = Auth::user()->id;		  
	  $alert_notification = AlertNotification::paginate(30);				
	 return view("admin/alert/notifications", compact("alert_notification"));
    }
}