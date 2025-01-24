<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use App\Models\Order;
use App\User;
use Mail;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlanController extends Controller{	
	 private $uploadPath = "public/uploads/";
    public function plans(){
		$records = SubscriptionPlan::where('status','1')->get();
		$data = array("message"=>"success","data"=>$records);	
	  return response($data, Response::HTTP_OK);
	}   
	
	public function planPurchase(Request $request){
		$user_plan= SubscriptionPlan::where('id',$request->plan_id)->first();
		$start_date = date('Y-m-d');
		$data = array("message"=>"error","error"=>"somthing wrong! try again");
		$day_limit = 30;
	  if($user_plan->day_limit == '6 Month'){
		  $day_limit = $day_limit*6;
	  }
	  if($user_plan->day_limit == '1 Year'){
		  $day_limit = $day_limit*12;
	  }
	  
	   $end_date = date('Y-m-d', strtotime($start_date.' + '.$day_limit.' days'));	
	  if($user_plan->day_limit == 'till Graduation'){
		$user = User::where('id',$request->user_id)->get();
		if($user[0]->student){
		 if(!empty($user[0]->student->graduation_date) && $user[0]->student->graduation_date != '1970-01-01'){
			$end_date = $user[0]->student->graduation_date;
		 }			 
		}
	  }	
		$records = Order::create([
					"user_id" => $request->user_id,
					"plan_id" => $request->plan_id,
					"start_date" => $start_date,
					"end_date" => $end_date,
					"plan_type" => $user_plan->plan_type,
					"plan_option"=>$user_plan->plan_option,
					"total_interview"=>$user_plan->interview_count,					
					"payment_type"=> $request->payment_type,
					"tx_id" => $request->tx_id,
					"total_amount"=>$user_plan->price,
				  ]);		
		$data = array("message"=>"success","data"=>$records);	
	  return response($data, Response::HTTP_OK);	
	}

    public function checkTotalInter($user_id)
    {
        $records = Order::where("user_id", $user_id)
           ->whereDate("end_date",'>=',NOW())
           ->sum("total_interview");

        $data = array("message"=>"success","data"=>$records,"profesional_price"=>10,"preskype_price"=>5);
        return response($data, Response::HTTP_OK);
    }

}