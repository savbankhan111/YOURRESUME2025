<?php

namespace App\Http\Controllers\Manager;

use App\Models\InterviewerSlot;
use App\Models\InterviewerSlotsBooked;
use App\Models\Job;
use App\User;
use App\Models\ManagerUser;
use App\Models\UserAddress;
use App\Models\UserProfile;
use App\Models\State;   
use App\Models\Country;
use App\Models\Industry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Lang;
use Vimeo\Laravel\Facades\Vimeo;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
	
	public function manageallInterviews(){
	$slots = InterviewerSlotsBooked::where("manager_id", Auth::id())->count();
		$pendingslots = InterviewerSlotsBooked::where("status", 'pending')->where("manager_id", Auth::id())->count();
        return view("manager.dashboard2")->with(['pendingslots'=>$pendingslots,'slots'=>$slots]);
    }
	
		public function profile(){
		$industry = Industry::get();
		$country = Country::where('id',231)->get();		
		$state = State::where('country_id',231)->get();
		$user = Auth::user();
        return view("manager.my_profile")->with(['user'=>$user,'country'=>$country,'state'=>$state,"industry"=>$industry]);
    }

	
    public function updateProfile(Request $request){
        $user = Auth::user();
        $data = User::findOrFail($user->id);
		
        $this->validate($request, [
			'first_name'=> 'required|min:2',
            'email' => 'required|email|unique:users,email,'.$user->id
        ]);
		if ($request->password != "") {
			$request->validate(['password'=> 'min:8']);
        }
		 if ($request->password != "") {
            $data['password'] = bcrypt($request->password);
         }		 
		$data['industry_id']= $request->industry_type;
		$data['first_name']= $request->first_name;
		$data['last_name']= $request->last_name;
		//$data->status = $request->status;	
		if(!empty($request->image)){			
            $request->validate(['image' => 'mimes:png,jpeg,jpg,gif']);
            $fileFinalName = 'job_'.time().rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $path = 'public/images/';
            $request->file('image')->move($path, $fileFinalName);
            $data['image'] = $fileFinalName;
         }	
		
		
        $data->save();
			  
		ManagerUser::where('user_id', $user->id)
              ->update(["profession" => $request->profession,"expertise" =>$request->expertise]);	
		UserAddress::where('user_id', $user->id)
              ->update(["address" => $request->address,"city" =>$request->city,"province" =>$request->state,"country" =>$request->country]);	
		UserProfile::where('user_id', $user->id)
              ->update(["contact_no" => $request->contact_no,"about_me" => $request->about_me]);
        return redirect()->back()->with('success',  Lang::get('adminmsgs.profile_update'));
    }

    public function interviewSlots()
    {
      $slots = InterviewerSlot::where("manager_id", Auth::id())->first();
        return view("manager.list_slot", compact("slots"));
    }

    public function interviewSlotStore(Request $request){
        
        $dbdata = InterviewerSlot::where('manager_id', Auth::id())->select($request->day)->first();
        if(!$dbdata){
          $dbdata = InterviewerSlot::create(["manager_id" => Auth::id()]);
        }
         $data = ["start_time" => $request->start_time, "end_time" =>  $request->end_time];
        $arrays_merged = $this->getArrayData($request, $dbdata, $data);
         InterviewerSlot::updateOrCreate(['manager_id'=> Auth::id()],[
             $request->day => json_encode($arrays_merged)
         ]);

        return redirect()->back()->with('success', 'Successfully Time Added');

    }

    public function interviewSlotDelete($index, $day){
        $slots = InterviewerSlot::where("manager_id", Auth::id())->first();
        $dec = $this->decodeJson($day, $slots);
        unset($dec[$index]);
        InterviewerSlot::where('manager_id', Auth::id())->update([
            $day => json_encode($dec)
        ]);
         return redirect()->back()->with('success', 'Successfully Time Deleted');

    }


    public function interviewSlotEdit($index, $day)
    {
        $slots = InterviewerSlot::where("manager_id", Auth::id())->first();
        $dec = $this->decodeJson($day, $slots);
        $slot = $dec[$index];
        return view("manager.edit_slot", compact("slot", "day","index"));

    }

    public function interviewSlotUpdate(Request $request,$index, $day)
    {
        $slots = InterviewerSlot::where("manager_id", Auth::id())->first();
        $dec = $this->decodeJson($day, $slots);
        $dec[$index]["start_time"] = $request->start_time;
        $dec[$index]["end_time"] = $request->end_time;

        InterviewerSlot::where('manager_id', Auth::id())->update([
            $day => json_encode($dec)
        ]);

        return redirect()->route("interviewSlots")->with('success',  Lang::get('adminmsgs.success'));
    }

    /**
     * @param Request $request
     * @param $dbdata
     * @param array $data
     * @return array|null
     */
    public function getArrayData(Request $request, $dbdata, array $data)
    {
        $arrays_merged = null;
        if ($dbdata->{$request->day}) {
            $arrays_merged = array_merge($this->decodeJson($request->day, $dbdata), [$data]);
        } else {
            $arrays_merged = [$data];
        }
        return $arrays_merged;
    }

    /**
     * @param $day
     * @param $slots
     * @return mixed
     */
    public function decodeJson($day, $slots): array
    {
        $dec = json_decode($slots->{$day}, true);
        return $dec;
    }

    public function getInterviewerList(Request $request)
    {
		$status = $request->query('status');
		$isBooked = InterviewerSlotsBooked::where("manager_id", Auth::id());
		 if(isset($status)){
			$isBooked = $isBooked->where('status', $status);
		 }		  
        $interviewerUsers = $isBooked->paginate(30);
        return view("manager.interviewer_users", compact("interviewerUsers"));
    }
	
	 public function getInterview($id)
    {
        $interviewerUsers = InterviewerSlotsBooked::where("id", $id)->where("manager_id", Auth::id())->get();
		$interviewerUser = $interviewerUsers[0];
        return view("manager.single_interview", compact("interviewerUser"));
    }
	
// 	public function updateIVideo(Request $request,$id)
//     {
//         $slot = InterviewerSlotsBooked::where('id', $id)->where('manager_id', Auth::id())->first();
        
//           $u = User::where("id", $slot->user_id)->first();
//            $points = ($u->point - $slot->point) + $request->point;
           
//             $u->update(["point" => $points]);
// 			$videos="";
			
			
			
			
// 			/*if(!empty($request->video)){			
            
//             $fileFinalName = 'job_'.time().rand(1111,9999).'.'.$request->file('video')->getClientOriginalExtension();
//             $path = 'public/images/';
//             $request->file('video')->move($path, $fileFinalName);
//             $videos = $path.$fileFinalName;
//          }	
			
//      $videolink=   Vimeo::connection('main')->upload($videos);
       
      
//         File::delete($videos);*/
// 	$response="";
// 	if(!empty($request->video)){
	
// 	$curl = curl_init();
// 	curl_setopt_array($curl, array(
// 	  CURLOPT_URL => 'https://s3-api.bles-software.com/?&',
// 	  CURLOPT_RETURNTRANSFER => true,
// 	  CURLOPT_ENCODING => '',
// 	  CURLOPT_MAXREDIRS => 10,
// 	  CURLOPT_TIMEOUT => 0,
// 	  CURLOPT_FOLLOWLOCATION => true,
// 	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	  CURLOPT_CUSTOMREQUEST => 'POST',
// 	  CURLOPT_POSTFIELDS => array('file'=> new \CurlFile($request->file('video'), 'video/mp4', $id.'.mp4')),
// 	));
    

// 	$response = curl_exec($curl);

// 	curl_close($curl);
	
// 	$curl2 = curl_init();
// 	curl_setopt_array($curl2, array(
// 	  CURLOPT_URL => 'https://vimeo-api.bles-software.com/?&',
// 	  CURLOPT_RETURNTRANSFER => true,
// 	  CURLOPT_ENCODING => '',
// 	  CURLOPT_MAXREDIRS => 10,
// 	  CURLOPT_TIMEOUT => 0,
// 	  CURLOPT_FOLLOWLOCATION => true,
// 	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	  CURLOPT_CUSTOMREQUEST => 'POST',
// 	  CURLOPT_POSTFIELDS => array('file'=> new \CurlFile($request->file('video'), 'video/mp4', $id.'.mp4')),
// 	));

// 	$sdsds = curl_exec($curl2);
// $vimeoresponse=json_decode($sdsds);
// 	curl_close($curl2);
// 		}
// //'https://vimeo.com/manage'.$videolink
// 		$slot->update([
//             "video" => $response,
// 			"admin_feedback" => $request['admin_feedback'],
// 			"point" => $request['point'],
// 			"vimeo" => $vimeoresponse->vimeo_video_id
//         ]);
//        return redirect()->back()->with('success', 'Successfully Updated');
//     }
	


public function updateIVideo(Request $request, $id)
{
    $slot = InterviewerSlotsBooked::where('id', $id)->where('manager_id', Auth::id())->first();
    
    $u = User::where("id", $slot->user_id)->first();
    $points = ($u->point - $slot->point) + $request->point;
    $u->update(["point" => $points]);

    $response = "";
    $vimeoresponse = "";

    if (!empty($request->video)) {
        // Define S3 bucket details from .env
        $bucket = env('AWS_BUCKET');
        $region = env('AWS_DEFAULT_REGION');
        $accessKey = env('AWS_ACCESS_KEY_ID');
        $secretKey = env('AWS_SECRET_ACCESS_KEY');

        // Generate a unique file name for the video
        $fileName = 'job_' . time() . rand(1111, 9999) . '.mp4';
        $filePath = $request->file('video')->getPathname();

        // Upload to S3 with 'public-read' or 'private' ACL
        $s3Response = Storage::disk('s3')->putFileAs(
            'videos', // You can change this to the folder path within your bucket if needed
            $request->file('video'),
            $fileName,
            [
                'visibility' => 'public' // Use 'public' for public-read access or 'private' for private
            ]
        );

        // Get the URL of the uploaded file
        $response = Storage::disk('s3')->url($fileName);

        // Upload to Vimeo
        $curl2 = curl_init();
        curl_setopt_array($curl2, array(
            CURLOPT_URL => 'https://vimeo-api.bles-software.com/?&',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('file' => new \CurlFile($filePath, 'video/mp4', $fileName)),
        ));

        $sdsds = curl_exec($curl2);
        $vimeoresponse = json_decode($sdsds);
        curl_close($curl2);
    }

    $slot->update([
        "video" => $response,
        "admin_feedback" => $request['admin_feedback'],
        "point" => $request['point'],
        "vimeo" => $vimeoresponse->vimeo_video_id ?? null
    ]);

    return redirect()->back()->with('success', 'Successfully Updated');
}


	public function changeISBStatus(Request $request, $id)
    {
        $rec =  InterviewerSlotsBooked::find($id);
        $rec->status = $request->status;
        $rec->save();
        return redirect()->back()->with("success", Lang::get('adminmsgs.status_updated'));
    }
}