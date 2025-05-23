<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\InterviewerSlot;
use App\Models\InterviewerSlotsBooked;
use App\Models\Job;
use App\Models\ManagerUser;
use App\Models\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManagerController extends Controller
{
    public function getInterviewer($job_id,$totalDay){
        $date = Carbon::now();
        $days = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];
        $job =  Job::where("id", $job_id)->select("industry_id")->first();
        $indstries = $this->getIndUser($job);
        $ind = $this->checkingManHasTime($indstries);

        if (!$ind){
            $data = array("message"=>"error","manager"=>"not found");
            return response($data, Response::HTTP_OK);
        }

        $dbslot = InterviewerSlot::where("manager_id", $ind->id)->first();

      $manager = User::where("id", $ind->id)->first();
	  $manager_intoo = $manager->userInfo;
	 
        $professiondata=ManagerUser::where('user_id', $ind->id)->first();
        if(!empty($professiondata)){
            $manager['profession']=$professiondata->profession;
            $manager['expertise']=$professiondata->expertise;
            $manager['about_me']=$manager_intoo->about_me;
        }else{
            $manager['profession']="";
            $manager['expertise']="";
            $manager['about_me']="";
        }
        $mydays = array();
        for ($i = 0; $i < $totalDay; $i++ ){
            $date->addDays(1);
            $bookedSlots = InterviewerSlotsBooked::where("date", $date->format("Y-m-d"))->get();
            foreach ($days as $day) {
                if (strtolower($date->dayName) == $day) {
                    $times = $this->checkInsideArray($dbslot, $bookedSlots, $day);
                    
                    $mydays = $this->addToInsideArr($date, $times, $dbslot, $mydays);
                }
            }
        }

        $data = array("message"=>"success","manager"=>$manager, "times" =>$mydays);
        return response($data, Response::HTTP_OK);

    }


    public function getIndUser($job)
    {
        $indstries = User::where("industry_id", $job->industry_id)
            ->with("timeSlot")
            ->withCount("getCountBooked")
            ->orderBy('get_count_booked_count', 'asc')
            ->get();
        return $indstries;
    }

    public function checkingManHasTime($indstries)
    {
        $ind = null;
        foreach ($indstries as $indstry) {
            if ($indstry->timeSlot != null) {
                $ind = $indstry;
                break;
            }
        }
        return $ind;
    }




    public function checkInsideArray($dbslot, $bookedSlots,$day){
      $times = json_decode($dbslot->{$day}, true);
        
        
        foreach ($bookedSlots as $bookedSlot) {
            $key = 0;
            if (array_search($bookedSlot->start_time, array_column($times, 'start_time')) !== false) {
               array_splice( $times, $key, 1 );
                //unset($times[$key]);
            }
            $key++;
         
        }
        
        return $times;
    }

    public function addToInsideArr(Carbon $date, $times, $dbslot, array $mydays): array
    {
        $mydays[] = ["names" => $date->dayName, "date" => $date->format("Y-m-d"),"times" => $times, "manager_id"=>$dbslot->manager_id, "slot_id" => $dbslot->id];
        return $mydays;
    }

    public function bookInterviewSlot(Request $request)
    {
        InterviewerSlotsBooked::create([
            "interviewer_slots_id" => $request->interviewer_slots_id,
            "manager_id" => $request->manager_id,
            "user_id" => $request->user_id,
            "date" => $request->date,
            "payment" => $request->payment,
            "day" => strtolower($request->day),
            "start_time" => $request->start_time,
            "end_time" => $request->end_time,
            "interview_type" => $request->interview_type,
        ]);
        
        if($request->payment=='plain'){
            $dates=date('y-m-d');
           $data= Order::where('end_date','>=', $dates)->where('total_interview','!=','0')->where('user_id',$request->user_id)->first();
            if($data!=null){
                $total_interview= $data->total_interview-1;
                Order::where('id', $data->id)->update(['total_interview' => $total_interview]);
                
            }
        }

        return response(["message"=>"success"], Response::HTTP_OK);

    }
    
    
    public function bookInterviewSlotList($user_id){
        $intList = InterviewerSlotsBooked::where("user_id", $user_id)
        ->orderBy("date", 'DESC')
        ->orderBy("start_time", 'DESC')
        ->get();
        
        $data = array("message"=>"success","data"=>$intList);
        return response($data, Response::HTTP_OK);

        
    }
    
}
