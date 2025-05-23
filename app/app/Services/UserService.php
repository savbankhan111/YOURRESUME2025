<?php

namespace App\Services;
use App\Models\Role;
use App\Models\ManagerUser;
use App\Models\Professional;
use App\Models\Employer;
use App\Models\UserAddress;
use App\Models\UserProfile;
use App\Models\Student;
use App\Models\School;
//use App\Models\UserNotification;
use App\Models\Order;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use DB;
class UserService
{
    public function empList(Request $request, $name)
    {			
		$std_type = $name;
		if($name == 'non-student'){
			$name = 'student';
		}
        $role = Role::where("roles",$name)->first();
        $searchval = $request->query('search');
        $status = $request->query('status');
        $date = $request->query('date');
		$school = $request->query('school');
        $roleid = $role->id;
		  if(isset($status)){
				$candidates = User::where('status', $status);
		  }else{
			  $candidates = User::where('id','!=',0);
		  }

        if ($request->query('date')  != null && $request->query('date') != "change"){
            $candidates->where('created_at', '>=', $date);
        }
        $candidates->whereHas('roles', function ($query) use ($name, $roleid,$searchval) {
            $query->where('roles.id', $roleid);
			//$searchval ? ($searchval =="all"? '!=' :'=') : '=', 
        });

		if ($name == 'student'){
			if($std_type == 'non-student'){
			 $candidates->whereHas('student', function ($query){
				$query->whereNull('students.school_id'); 
			 });
            } else {
			$candidates->whereHas('student', function ($query){
				$query->whereNotNull('students.school_id'); 
			 });
			}				
			if($school != 'change' && $school != null){		
			 $candidates->whereHas('student', function ($query) use ($school) {
              $query->where('students.school_id', $school);
			 });
            }			
        }
		//$candidates->toSql();
		//dd($candidates);
        return $candidates->latest();
    }
	
	public function empSchool(Request $request,$option='direct')
    {				
       // $searchval = $request->query('search');
        $status = $request->query('status');
		  if(isset($status)){
				$candidates = School::where('status', $status);
		  }else{
			  $candidates = School::where('id','!=',0);
		  }

       	if ($option){
			$candidates->where('school_type', $option);
		}
		//$candidates->toSql();
		//dd($candidates);
        return $candidates->latest();
    }
	
    /* public function userDestroy(Request $request, $userId)
    {
		$user =  User::where('id',$userId)->first();
		if($user->roles[0]->id == 1){
			//student
			Student::where('user_id',$userId)->delete();
		}if($user->roles[0]->id == 2){
		   //professional			 
			Professional::where('user_id',$userId)->delete();
			Order::where('user_id',$userId)->delete();
		}if($user->roles[0]->id == 3){
			FamilyFriend::where('user_id',$userId)->delete();
			Order::where('user_id',$userId)->delete();
		}	
		User::where('id',$userId)->delete();		
		DB::table('role_user')->where('user_id', $userId)->delete();
	    $gc = GroupCode::where('user_id',$userId)->first();
		if($gc){
		 $gu = GroupUser::where('group_code_id',$gc->id)->get();
		 if(sizeof($gu) < 2){
			 GroupCode::where('user_id',$userId)->delete();
		 }
			GroupUser::where('user_id',$userId)->delete();
		}	
		return true;	
	}*/
	
	public function userUpdate(Request $request, $User){			
		if ($request->password != "") {
				$request->validate(['password'=> 'min:8']);
        }
		//$User = User::findOrFail($id);
		$User->first_name = $request->first_name;
        $User->last_name = $request->last_name;
            if ($request->password != "") {
                $User->password = bcrypt($request->password);
            }			
		$User->status = $request->status;	
		if(!empty($request->image)){			
            $request->validate(['image' => 'mimes:png,jpeg,jpg,gif']);
            $fileFinalName = time().rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $path = 'public/uploads/profile/';
            $request->file('image')->move($path, $fileFinalName);
			$User->image = $fileFinalName;
        }		
		$User->save();		
		
		UserProfile::where('user_id', $User->id)->update(["contact_no" => $request->contact_no]);		
		UserAddress::where('user_id', $User->id)
              ->update([
					"address"=> $request->address,
					"street_name"=> $request->street_name,
					"city" => $request->city,
					"province"=> $request->province,
					"zipcode"=> $request->zipcode,
					"country"=> $request->country				
				]);
				
		if($User->roles[0]->id == 1){
			if(empty($request->school_id)){
			 $request->school_id = NULL;
			}
			Student::where('user_id', $User->id)
              ->update([
					"school_id"=>$request->school_id,
					"major"=>$request->major,
					"minor"=>$request->minor,		
					"indication"=>$request->indication,
					"graduation_date"=>date('Y-m-d',strtotime($request->graduation_date)),
					"other"=> $request->other,			
				]);
			
			if(!empty($request->school_proff_id)){
             $school_proff_id = 'sic-'.time().rand(1111,9999).'.'.$request->file('school_proff_id')->getClientOriginalExtension();
             $path = 'public/uploads/profile/id_card/';
             $request->file('school_proff_id')->move($path, $school_proff_id);
			 Student::where('user_id', $User->id)->update(['school_proff_id' => $school_proff_id]);
			}	
		}elseif($User->roles[0]->id == 3){
			Professional::where('user_id', $User->id)->update(["interested_industry" => $request->interested_industry]);
		}
	}
	
	public function schoolStore(Request $request){
		 $request->validate([
				 'school_name'=> 'required|min:2',
				 //'contact_no'=> 'required|unique:users'
                ]);
		 if(!empty($request->school_code)){		
			$request->validate([
				 'school_code'   => 'required|min:2|unique:schools',
                ]);	
		 }
		  if(!isset($request->school_type)){
			$school_type = 'direct';
		  } else {
			$school_type = $request->school_type;
		  }
		  School::create([
					"school_name"=>$request->school_name,
					"school_code"=>$request->school_code,
					"school_type"=>$school_type,
					"more_info"=>trim($request->more_info),
					"address" => $request->address,
					"city"=>$request->city,
					"state"=>$request->state,
					"country"=>$request->country,
					"status"=>$request->status,
					"zip_code"=>$request->zip_code,
					"contact_no"=>$request->contact_no,
				]);						 		
    }
	public function schoolUpdate(Request $request, $User)
    {			
	   $request->validate(['school_name'=> 'required|min:2']);
			School::where('id', $User)
              ->update([
					"school_name"=>$request->school_name,
					"school_code"=>$request->school_code,
					"more_info"=>trim($request->more_info),
					"address" => $request->address,
					"city"=>$request->city,
					"state"=>$request->state,
					"country"=>$request->country,
					"status"=>$request->status,
					"zip_code"=>$request->zip_code,
					"contact_no"=>$request->contact_no,		
				]);		
	}
    public function profileEdit(Request $request, $user)
    {
        return redirect(route("admin.profileEdit", $user->id))->with('success',  Lang::get('adminmsgs.success'));
    }
	public function updateManager(Request $request, $User){			
	   
		$request->validate([
				 'first_name'=> 'required|min:2',
				 'last_name'=>'required',
				 'contact_no'=> 'required',
                ]);
		if ($request->password != "") {
				$request->validate(['password'=> 'min:8']);
        }
		$User->industry_id= $request->industry_type;
		$User->first_name= $request->first_name;
		$User->last_name= $request->last_name;
            if ($request->password != "") {
                $User->password = bcrypt($request->password);
            }		
		$User->status = $request->status;		
		$User->save();	
		ManagerUser::where('user_id', $User->id)
              ->update(["profession" => $request->profession,"expertise" =>$request->expertise]);	
		UserAddress::where('user_id', $User->id)
              ->update(["address" => $request->address,"city" =>$request->city,"province" =>$request->state,"country" =>$request->country]);	
		UserProfile::where('user_id', $User->id)
              ->update(["contact_no" => $request->contact_no,"about_me" => $request->about_me]);					
	}
	
	public function managerStore(Request $request){
		 $request->validate([
				 'first_name'=> 'required|min:2',
				 'last_name'=>'required',
				 'password'=> 'required|min:8',
				 'email'   => 'required|email|unique:users',
				 'contact_no'=> 'required',
                ]);
		$email_verified_code = null;
		$email_verified_at = date('Y-m-d 00:00:00');		
        $User = User::create([
			"industry_id"=>$request->industry_type,
			"first_name"=>$request->first_name,
			"last_name"=>$request->last_name,
            "email"=>$request->email,
			"email_verified_at"=>$email_verified_at,
			"email_verified_code"=>$email_verified_code,
            "password"=> bcrypt($request->password),
			"status"=>$request->status,
          ]);
		$User->roles()->attach(4);
		ManagerUser::create(["user_id"=> $User->id,"profession" => $request->profession,"expertise" =>$request->expertise]);	
		UserAddress::create(["user_id"=> $User->id,"address" => $request->address,"city" =>$request->city,"province" =>$request->state,"country" =>$request->country]);	
		UserProfile::create(["user_id"=> $User->id,"contact_no" => $request->contact_no,"about_me" => $request->about_me]);		
    }
	
	public function updateEmployer(Request $request, $User){			
	   
		$request->validate([
				 'first_name'=> 'required|min:2',
				 'last_name'=>'required',
                ]);
		if ($request->password != "") {
			$request->validate(['password'=> 'min:8']);
        }
		$User->first_name= $request->first_name;
		$User->last_name= $request->last_name;
         if ($request->password != "") {
            $User->password = bcrypt($request->password);
         }		
		$User->status = $request->status;		
		$User->save();		
		Employer::where('user_id', $User->id)
              ->update(["phone_number" => $request->phone_number,"fax" =>$request->fax,"expire_ac" =>$request->expire_ac]);	
		UserAddress::where('user_id', $User->id)
              ->update(["address" => $request->address,"city" =>$request->city,"province" =>$request->state,"country" =>$request->country]);
	}
	
	public function employerStore(Request $request){
		 $request->validate([
				 'first_name'=> 'required|min:2',
				 'last_name'=>'required',
				 'password'=> 'required|min:8',
				 'email'   => 'required|email|unique:users'
                ]);
		$email_verified_code = null;
		$email_verified_at = date('Y-m-d 00:00:00');		
        $User = User::create([
			"first_name"=>$request->first_name,
			"last_name"=>$request->last_name,
            "email"=>$request->email,
			"email_verified_at"=>$email_verified_at,
			"email_verified_code"=>$email_verified_code,
            "password"=> bcrypt($request->password),
			"status"=>$request->status,
          ]);
		$User->roles()->attach(2);
		Employer::create(["user_id"=> $User->id,"phone_number" => $request->phone_number,"fax" =>$request->fax,"expire_ac" =>$request->expire_ac]);	
		UserAddress::create(["user_id"=> $User->id,"address" => $request->address,"city" =>$request->city,"province" =>$request->state,"country" =>$request->country]);	
    }
}