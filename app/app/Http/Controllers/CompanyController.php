<?php
namespace App\Http\Controllers;

//use App\Http\Requests\UserValidation;
use App\Models\FamilyFriend;
use App\Models\GroupCode;
use App\Models\GroupUser;
use App\Models\Order;
use App\Models\Professional;
use App\Models\Role;
use App\Models\Company;
//use App\Services\UserService;
use App\Models\AlertNotification;
use App\Models\UserNotification;
use App\Models\ParentAlert;
use App\Models\SubAlert; 
use App\Models\AlertMediaFile;
use App\Models\State;
use App\Models\Country;
use App\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class CompanyController extends Controller{

    public function userListBy(Request $request){
		$user = Auth::user();
        $candidates = Professional::where("company_id", $user->id)->with("user");

        return view("crm/users_list")
            ->with(['candidates'=> $candidates->paginate(30)]);


    }

    public function userDetails(User $user)
    {
        return view("crm.user_details", compact("user"));
    }

    public function editUser(User $user){
		$country = Country::where('id',231)->get();		
		$state = State::where('country_id',231)->get();
        $schools = User::whereHas('roles', function ($query){
            $query->where('roles.id', 5);})->get();
        return view("crm.user_edit", compact("user","schools","country","state"));
    }


		public function userUpdate(Request $request,User $User)
    {

		if ($request->password != "") {
				$request->validate(['password'=> 'min:8']);
        }
		if ($request->contactNo != $User->contactNo) {
                $request->validate([
                    'contactNo' => 'unique:users',
                ]);
        }
		//$User = User::findOrFail($id);
		$User->firstname = $request->firstname;
        $User->lastname = $request->lastname;
            if ($request->password != "") {
                $User->password = bcrypt($request->password);
            }
		$User->permanentAddress = $request->permanentAddress;
		$User->streetAddress1 = $request->streetAddress1;
		$User->streetAddress2 = $request->streetAddress2;
		$User->city = $request->city;
		$User->state = $request->state;
		$User->country = $request->country;
		$User->status = $request->status;
		$User->contactNo = $request->contactNo;
		if(!empty($request->image)){
            $request->validate(['image' => 'mimes:png,jpeg,jpg,gif']);
            $fileFinalName = time().rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $path = 'public/uploads/profile/';
            $request->file('image')->move($path, $fileFinalName);
			$User->image = $fileFinalName;
        }
		$User->save();

		if($User->roles[0]->id == 1){
			Student::where('user_id', $User->id)
              ->update([
					"school_id"=>$request->school_id,
					"majaor"=>$request->majaor,
					"indication"=>$request->indication,
					"graduation"=>$request->graduation,
					"other"=>$request->other,
					"verify"=>$request->card_verify,
				]);
		}elseif ($User->roles[0]->id == 2){
			Professional::where('user_id', $User->id)
              ->update([
					//"company_name"=>$request->company_name,
					//"company_type"=>$request->company_type,
					"badge_id"=>$request->badge_id
				]);
		}elseif ($User->roles[0]->id == 3){
			FamilyFriend::where('user_id', $User->id)
              ->update([
					"nickname"=>$request->nickname,
					"family_name"=>$request->family_name,
					"membername"=>$request->membername,
					"memberphone"=>$request->memberphone
				]);
		}

        return redirect()->back()->with('success',  Lang::get('adminmsgs.success'));
    }


    public function userDelete(Request $request, $userId)
    {
        $user =  User::where('id',$userId)->first();

            Student::where('user_id',$userId)->delete();

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
        return redirect()->back()->with("success",Lang::get('adminmsgs.status_updated'));

    }

    public function changeUserStatus(Request $request, $userId){
        $user =  User::find($userId);
        $user->status = $request->status;
        $user->save();
        return redirect()->back()->with("success",Lang::get('adminmsgs.status_updated'));
    }
	
    public function sendNotification(){
		return view("crm/send_notification");
    }
	
	public function putSendNotification(Request $request){
		$request->validate(['header'=> 'required','description'=>'required']); 
		$cuser_id = Auth::user()->id;	 
		$students= Professional::where("company_id", $cuser_id)->select('user_id')->get();		
		if(sizeof($students) > 0){
			$message = trim($request['header']); 
			$description=trim($request['description']);
			$type =$request['type'];
		 $alert_notf = AlertNotification::create([
				"parent_id"=>$cuser_id,
				"type" => $type,
				"notification_type"=>'company',
				"message"=>$message,
				"description"=>$description
			]);	
		 foreach($students as $std){	
			UserNotification::create([
				"user_id" => $std->user_id,
				"alert_notification_id"=> $alert_notf->id,			
			]);
	      if(!empty($std->user->fcm_token)){
			$token = $std->user->fcm_token;
			$AlertNotification = AlertNotification::where('id',$alert_notf->id)->first();
$mess = array (
				'registration_ids' => array (
						$token
				),
				'data' => $AlertNotification
		);
		   $this->sendGCM($mess,$description, $token);
		  }
		 }
		}		
	  return redirect()->back()->with("success","Notification sent successfully.");
    }
	
	public function sentNotification(){
	  $cuser_id = Auth::user()->id;		  
	  $alert_notification = AlertNotification::where("parent_id",$cuser_id)->where("notification_type",'company')->paginate(30);				
	 return view("crm/notifications", compact("alert_notification"));
    }
		
	 public function parentAlerts(Request $request){
		$cuser_id = Auth::user()->id;			
        $candidates = Professional::where("company_id", $cuser_id)->select('user_id')->get()->toArray();	
		//$status = $request->query('status');
        $alerts = ParentAlert::whereIn("user_id",$candidates)->latest();
        $view = 'crm/parent_list';
        return view($view)->with(['alerts'=> $alerts->paginate(30)]);
    }
	
	public function subAlerts($parent_id){	
		$cuser_id = Auth::user()->id;			
        $candidates = Professional::where("company_id", $cuser_id)->select('user_id')->get()->toArray();
		
        $parent = ParentAlert::where('id',$parent_id)->whereIn("user_id",$candidates)->first();
        $alerts = SubAlert::where('parent_id',$parent_id)->whereIn("user_id",$candidates)->latest();
        $view = 'crm/sub_list';
        return view($view)->with(['parent'=>$parent,'alerts'=> $alerts->paginate(30)]);
    }
	
	public function parentGallery($parent_id){	
		$cuser_id = Auth::user()->id;			
        $candidates = Professional::where("company_id", $cuser_id)->select('user_id')->get()->toArray();
		
        $parent = ParentAlert::where('id',$parent_id)->whereIn("user_id",$candidates)->first();
        $alerts = AlertMediaFile::where('parent_id',$parent_id)->latest();
        $view = 'crm/media_list';
        return view($view)->with(['parent'=>$parent,'alerts'=> $alerts->paginate(30)]);
    }
	
	public function changeParentStatus(Request $request, $parent_id){
		$parent =  ParentAlert::find($parent_id);
		$parent->status = $request->status;
		$parent->save();
        return redirect()->back()->with("success",Lang::get('adminmsgs.status_updated'));
    }
	
	public function profile(){
		$country = Country::where('id',231)->get();		
		$state = State::where('country_id',231)->get();
		$user = Auth::user();
        return view("crm.my_profile")->with(['user'=>$user,'country'=>$country,'state'=>$state]);
    }
    public function updateProfile(Request $request){
        $user = Auth::user();
        $data = User::findOrFail($user->id);
		
        $this->validate($request, [
            'company_name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,'.$user->id
        ]);
		if ($request->password != "") {
				$request->validate(['password'=> 'min:8']);
        }			
		if ($request->contactNo != $user->contactNo) {
                $request->validate([
                    'contactNo' => 'unique:users',
                ]);
        }
		 if ($request->password != "") {
                $data['password'] = bcrypt($request->password);
         }
		//$data['firstname'] = $request->firstname;
        $data['permanentAddress'] = $request->permanentAddress;
		$data['streetAddress1'] = $request->streetAddress1;
		$data['streetAddress2'] = $request->streetAddress2;
		$data['city'] = $request->city;
		$data['state'] = $request->state;
		$data['country'] = $request->country;
		//$data->status = $request->status;
		$data['contactNo'] = $request->contactNo;	
         $data->save();
		 Company::where('user_id', $user->id)
              ->update([
					"company_name"=>$request->company_name,
					"company_type"=>$request->company_type,			
				]);	
        return redirect()->back()->with('success',  Lang::get('adminmsgs.profile_update'));
    }
}
