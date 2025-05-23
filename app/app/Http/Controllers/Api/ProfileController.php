<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Languages;
use App\Models\School;
use App\Models\Student;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Log;

use App\Models\UserDocuments;
use App\Services\AuthService;
use App\User;
use App\Models\State;
use App\Models\Order;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UserResume;
use App\Models\Experience;
use App\Models\SkillField;
use App\Models\SchoolData;
use App\Models\JobUser;
use App\Models\Skill;
use Illuminate\Support\Facades\Hash;

use App\Models\InterviewerSlotsBooked;

class ProfileController extends Controller{	
	private $uploadPath = "public/public/uploads/";
	
	public function states(Request $request){
		$data = array("message"=>"success","data"=>State::where('country_id', 231)->get());	
		return response($data, Response::HTTP_OK);	
	} 
	
	public function SchoolByState($state){
	  $schools = School::where('state', $state)->where('status', 'active')->where('school_type','!=', 'non')->get();
	  $record = 'empty';		
	 if(sizeof($schools) > 0){
		$record = $schools; 
	 }	 
	  $data = array("message"=>"success","data"=>$record);	
	 return response($data, Response::HTTP_OK);	
	}


    public function NonSchoolByState($state){
        $schools = School::where('state', $state)->where('status', 'active')->where('school_type', 'non')->get();
        $record = 'empty';		
       if(sizeof($schools) > 0){
          $record = $schools; 
       }	 
        $data = array("message"=>"success","data"=>$record);	
       return response($data, Response::HTTP_OK);	
      }
	
    public function userFLUpdate(Request $request){
		User::where('id', $request->id)->update(['first_name' => $request->first_name,'last_name' => $request->last_name]);
	
		UserAddress::where('id', $request->id)->update(['address' => $request->streetaddress1,'street_name' => $request->streetaddress2,'city' => $request->city,'province' => $request->state,'country' => $request->country,'zipcode' => $request->zipcode]);
		
		$data = array("message"=>"success","data"=>"Record updated successfully.");	
	  return response($data, Response::HTTP_OK);	
	}
	
    public function infoByCode(Request $request, AuthService $authService){
		$data = 'empty';
		if(!empty($request->code)){
            $code = GroupCode::WHERE('code',$request->code)->first();
		 if($code){
	        $users = $code->user;
		  if(isset($users->roles[0])){	
			$type = $users->roles[0]->id;
		   if($type == 1){
            // student
			$data = $users->student->school;
           }elseif ($type == 2){
            // professional
			$data = $users->professional;
           }
		  }
		 }			
		}
		$data = array("message"=>"success","data"=>$data);
	  return response($data, Response::HTTP_OK);	        		
	}	
	
    public function updateLatLg(Request $request){
		User::where('id', $request->user_id)->update(['lat'=> $request->lat,'lng'=> $request->lng,'fcm_token'=> $request->fcm_token]);  
		$data = array("message"=>"success","data"=>"Record updated successfully.");	
		return response($data, Response::HTTP_OK);	
	}  	
	 
	
	public function schoolSearch(Request $request){
	  $schools = User::join('schools', 'users.id', '=', 'schools.user_id')
				 ->join('group_codes', 'users.id', '=', 'group_codes.user_id')
				 ->where('users.state', $request->state)
				 ->where('schools.school_name', 'LIKE', '%'.$request->school_name.'%')
				 ->select('users.email','users.contactNo','users.status','schools.*','group_codes.code')->get();
		$record = 'empty';		
	 if(sizeof($schools) > 0){
		$record = $schools; 
	 }	 
	  $data = array("message"=>"success","data"=>$record);	
	 return response($data, Response::HTTP_OK);	
	}

    public function changePassword(Request $request){
		if(!empty($request->oldpassword)){
		 $users=User::where('id', $request->id)->first();
		 if(!Hash::check($request->oldpassword, $users->password)){
				$data = array("message"=>"error","error"=>"Old password not match.");	
				return response($data, Response::HTTP_OK);	
		 }
		}
		if(!empty($request->password)){
		 User::where('id', $request->id)->update(['password' => bcrypt($request->password)]);
		}
		 $data = array("message"=>"success","data"=>"Password changed successfully.");	
		return response($data, Response::HTTP_OK);	
	}
	
	public function userActDeact(Request $request){
		 $data = array("message"=>"error","error"=>"somthing wrong! try again");	
		if($request->status == 'active'){			
		 $group = GroupUser::where('user_id',$request->loggin_id)->select('group_code_id')->first();
		 $cur_date = date('Y-m-d');
		 if($group){
		  $group_order = Order::where('group_code_id',$group->group_code_id)->where('to_date', '>=', $cur_date)->orderBy('id', 'ASC')->first();
	      if($group_order){
			$act_gusers = GroupUser::join('users', 'users.id', '=', 'group_users.user_id')
				 ->where('group_users.group_code_id',$group->group_code_id)
				 ->where('users.status', 'active')
				 ->select('users.*')->get();
			
			$act_guser_count = sizeof($act_gusers);
			if($act_guser_count < $group_order->user_limit){
			 User::where('id', $request->user_id)->update(['status'=> $request->status]); 
			 $data = array("message"=>"success","data"=>"Record updated successfully.");				 
			} else {				
			 $data = array("message"=>"error","error"=>"Your user limit is over, you can not active this user.");	
			}
		  }		  
		 }
		} else {
		 User::where('id', $request->user_id)->update(['status'=> $request->status]); 		 
		 $data = array("message"=>"success","data"=>"Record updated successfully.");		
		}
	 return response($data, Response::HTTP_OK);	
	}

    public function uploadDocument(Request $request, $user_id)
    {
        $this->deleteDirectory($request, $user_id);
        $file = $this->addDocument($request, $user_id);
        UserDocuments::updateOrCreate(['user_id'=> $user_id,"type" => $request->type],[
            "type" => $request->type,
            "user_id" => $user_id,
            "title" => $request->title,
            "file_name" => $file,
        ]);

        return response(["message"=>"success"], Response::HTTP_OK);
	}

    /**
     * @param Request $request
     * @param $user_id
     */
    public function deleteDirectory(Request $request, $user_id): void
    {
        Storage::deleteDirectory('documents/' . $user_id . '/' . $request->type);
    }

    /**
     * @param Request $request
     * @param $user_id
     * @return mixed
     */
    public function addDocument(Request $request, $user_id)
    {
        $file = Storage::putFile('documents/' . $user_id . '/' . $request->type, new File($request->file_name));
        return $file;
    }

    /*
     * Three api
     * language, usersdocuments, appointments
     * */
    public function lanApointDocs($user_id)
    {
      $langs =   Languages::all();
      $docs =  UserDocuments::where("user_id", $user_id)->get();
       $appoits = Appointment::where("user_id", $user_id)->get();
        $db = ["langs" => $langs, "docs" => $docs, "appoints" => $appoits];
        $data = array("message"=>"success","data"=> $db);
        return response($data, Response::HTTP_OK);
    }

    public function addAppoint(Request $request)
    {
        Appointment::updateOrCreate(['user_id'=> $request->user_id],[
            "user_id"=> $request->user_id,
            "status" =>$request->status,
            "language"=> $request->language,
            "location" => $request->location,
            "school" => $request->school,
            "type_of_degree" => $request->type_of_degree,
            "years_of_experience" => $request->years_of_experience,
            "gpa_range" => $request->gpa_range,
            "intership_co_op_exp" => $request->intership_co_op_exp,
            "residency" => $request->residency,
            "position_held" => $request->position_held,
            "professional_licenses"=>$request->professional_licenses,
            "certifications" => $request->certifications
        ]);
        return response(["message"=>"success"], Response::HTTP_OK);

    }

   public function getResumeProfile($user_id){
        list($resume, $experience, $skills, $transcript, $recommendationletter, $school) = $this->byUserIdGetTables($user_id);
        $mx = $this->getAllTables($resume, $experience, $skills, $transcript, $recommendationletter, $school);
        return $mx;

    }

    /**
     * @param $resume
     * @param $experience
     * @param $skills
     * @param $transcript
     * @param $recommendationletter
     * @return array
     */
    public function getAllTables($resume, $experience, $skills, $transcript, $recommendationletter, $school): array
    {
        $mx = ["message" => "success"];
        $mx["data"] = $resume;
        $mx["data"]["experience"] = $experience;
        $mx["data"]["skills"] = $skills;
        $mx["data"]["transcript"] = $transcript;
        $mx["data"]["recommendationletter"] = $recommendationletter;
        $mx["data"]["schoool"] = $school;
        $mx["data"]["languages_name"] = Languages::all();
        $mx["data"]["skill_name"] = Skill::all();
        return $mx;
    }

    /**
     * @param $user_id
     * @return array
     */
    public function byUserIdGetTables($user_id): array
    {
        $resume = UserResume::where("user_id", $user_id)->with("language")->first();
        $experience = Experience::where("user_id", $user_id)->get()->toArray();
        $skills = SkillField::where("type", "user")->where("job_id", $user_id)->with("skillData")->get()->pluck("skillData");
        $transcript = UserDocuments::where("type", "transcript")->where("user_id", $user_id)->get();
        $recommendationletter = UserDocuments::where("type", "reccom_letter")->where("user_id", $user_id)->get();
        $school = SchoolData::where("user_id", $user_id)->get();
        
        return array($resume, $experience, $skills, $transcript, $recommendationletter, $school);
    }
    
    public function userJobAppliedList($user_id){
        
        $appliedList = User::where("id", $user_id)->first();   
         return response(["message"=>"success", "data"=>$appliedList->jobsApplied], Response::HTTP_OK);
    }
    
    public function applyJob($user_id, $job_id){
        
          $int = InterviewerSlotsBooked::where("user_id", $user_id)->where("admin_feedback", "pass")->first();
        $message=null;
        if($int){
			$jobspply=JobUser::where('user_id' , $user_id)->where('job_id' , $job_id)->first();
			if($jobspply){
				$message = "duplicate";
			}else{
			JobUser::firstOrCreate([
					'user_id' => $user_id,
					'job_id' => $job_id,
				]);
				 $message = "success";
			}
       
        }else{
            $message = "error";
        }
       return response(["message"=>$message], Response::HTTP_OK);
 
    }
    
   
    
    public function updateUserResume(Request $request, $user_id)
    {
        Log::info('Request Data:', $request->all());

        // Request se '_token' hatao aur baki data lo
        $data = $request->except('_token');
    
        // Agar request empty hai to error return karo
        if (empty($data) || !is_array($data)) {
            return response()->json(["message" => "No valid data provided"], Response::HTTP_BAD_REQUEST);
        }
    
        try {
            // UserResume ka record update ya create karo
            $resume = UserResume::updateOrCreate(
                ["user_id" => $user_id], // Matching Criteria
                $data // Request ka data update ya insert karega
            );
    
            return response()->json(["message" => "success", "data" => $resume], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(["message" => "Error: " . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    

public function addInMultiTable(Request $request, $user_id, $type){
    
     $u = $this->UserModel($user_id);
    if($type == "lang"){
   $u->language()->attach($request->languageId,['type'=> "users","native"=> $request->native, "level" => $request->level ]);
   }elseif ($type == "experience"){
       $current="n";
       if(!empty( $request->current)){
           $current=$request->current;
       }
       Experience::create([
            "user_id" => $request->user_id,
           "company_name" => $request->company_name,
           "position" => $request->position,
            "current" => $current,
          "start" => $request->start,
           "end" => $request->end
       ]);
   }elseif ($type == "schoolData"){
        SchoolData::create([
            "user_id" => $user_id,
            "school_name" => $request->school_name,
            "class_name" => $request->class_name,
            "start_year" => $request->start_year,
            "passing_year" => $request->passing_year
        ]);
    }
   else{
    $sk = SkillField::firstOrCreate([
       "job_id" => $user_id,
        "type" => "user",
        "skill_id" => $request->skillId
    ]);
   }
     return response(["message"=>"success"], Response::HTTP_OK); 
}

    public function deleteInMultiTable($user_id, $delete_id ,$type)
    {
        $u = $this->UserModel($user_id);
        if($type == "lang"){
            $u->language()->detach($delete_id);
        }elseif ($type == "skill"){
            SkillField::where("job_id", $user_id)
                    ->where("type", "user")
                    ->where("skill_id", $delete_id)->delete();
        }elseif ($type == "experience"){
            Experience::where("user_id", $user_id)
                ->where("id", $delete_id)->delete();
        }elseif ($type == "school"){
            SchoolData::where("user_id", $user_id)
                ->where("id", $delete_id)
                ->delete();
        }elseif($type== "docs"){
            UserDocuments::where("id", $delete_id)->delete();
        }

        return response(["message"=>"success"], Response::HTTP_OK);


    }

    /**
     * @param $user_id
     * @return mixed
     */

    public function UserModel($user_id)
    {
        $u = UserResume::where("user_id", $user_id)->first();
        if(is_null($u)){
            $u = User::where("id", $user_id)->first();
        }
        return $u;
    }

    public function allTableUpdate(Request $request, $user_id, $update_id,$type)
    {
        if($type == "experience"){
        Experience::where("user_id", $user_id)
            ->where("id", $update_id)
            ->update([
            "user_id" => $request->user_id,
            "company_name" => $request->company_name,
            "position" => $request->position,
            "start" => $request->start,
            "end" => $request->end
        ]);
        }elseif ($type == "school"){
            SchoolData::where("user_id", $user_id)
                ->where("id", $update_id)
                ->update([
                "user_id" => $user_id,
                "school_name" => $request->school_name,
                "class_name" => $request->class_name,
                "start_year" => $request->start_year,
                "passing_year" => $request->passing_year
            ]);
        }elseif ($type == "resume"){
            UserResume::where("id", $user_id)->update($request->all());
        }



        return response(["message"=>"success"], Response::HTTP_OK);

    }
    
     public function profileImage(Request $request, $user_id)
    {
        if(!empty($request->image)){
            $fileFinalName = time().rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $path = $this->uploadPath.'profile/';
            $request->file('image')->move($path, $fileFinalName);
            User::where('id', $user_id)->update(['image' => $fileFinalName]);
            $data = array("message"=>"success","data"=>"image uploaded successfully.");
            return response($data, Response::HTTP_OK);
        }
    }

       public function studentIdCardUpdate(Request $request)
    {
        $user_id=$request->id;
        if(!empty($request->id_card)){
            $fileFinalName = time().rand(1111,9999).'.'.$request->file('id_card')->getClientOriginalExtension();
            $path = $this->uploadPath.'profile/';
            $request->file('id_card')->move($path, $fileFinalName);
            Student::where('user_id', $user_id)->update(['school_proff_id' => $fileFinalName]);
            $data = array("message"=>"success","data"=>"image uploaded successfully.");
            return response($data, Response::HTTP_OK);
        }
    }

    
    
}