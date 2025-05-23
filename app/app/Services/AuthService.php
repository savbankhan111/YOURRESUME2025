<?php
namespace App\Services;
use App\Models\UserProfile;
use App\Models\Professional;
use App\Models\Student;
use App\Models\UserAddress;
use App\Models\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    public function checkGroup(Request $request, $groupCode, $groupGen)
    {
		if(!empty($groupCode)){
         $bool = GroupCode::where("code",$groupCode)->first();
	     if ($groupGen == null || empty($groupGen)){
            return $bool?$bool->id:null;
         }
		}		
		$messages = array('code.unique' => 'Group code is already available. Please change your group code.');
		$validator = Validator::make($request->all(), [
            //'code' => 'required|unique:group_codes|max:255',
			'code' => 'unique:group_codes|max:255',
        ],$messages);
		if ($validator->fails()){			
			$error_val = array_values(json_decode(json_encode($validator->errors()), true));
			return $error_val[0];
        }
        //$groupGen = GroupCode::create(["code" => $groupGen]);
        return $groupGen;
    }
	
	public function createGroup(Request $request, $groupGen,$user_id)
    {
        $groupGen = GroupCode::create(["user_id"=>$user_id, "code" => $groupGen]);
        return $groupGen->id;
    }
	
    public function addStudent(Request $request,$userId)
    {
       return Student::create([
            "user_id" => $userId,
            "school_id"=>$request->school_id,
			"school_name"=>$request->school_name,
            "major" => $request->major,
			"minor" => $request->minor,
            "indication" => $request->indication,
            "graduation_date" => date('Y-m-d',strtotime($request->graduation_date)),
            "other" => $request->other,		
        ]);
    }

    public function addAddress(Request $request, $userId)
    {
        return UserAddress::create([
            "user_id"=> $userId,
            "address"=> $request->streetAddress1,
			"street_name"=> $request->streetAddress2,
            "city" => $request->city,
			"province"=> $request->state,
			"zipcode"=> $request->zipcode,
			"country"=> $request->country
        ]);
    }
	
	 public function addProfessional(Request $request, $userId)
    {
        return Professional::create([
            "user_id" => $userId,
			"interested_industry" => $request->interested_industry,
        ]);
    }

    public function addProfile(Request $request, $userId)
    {
        return UserProfile::create([
            "user_id" => $userId,
			"contact_no" => $request->contact_no,
        ]);
    }	
	
	  public function addPayment(Request $request, $group_code_id)
    {
        return Order::create([
            "group_code_id" => $group_code_id,
            "from_date" => date('Y-m-d'),
            "to_date" => "2030-12-31",
            "payment_type"=> "free",
			"token_id" => "free",
        ]);
    }

    public function validationAll(Request $request, $type){
		$messages = array('email.unique' => 'Email id is already register. Please check your email id.');
		$validator = Validator::make($request->all(),[
            'email' => 'required|unique:users|max:255',
		],$messages);		
		if($validator->fails()){
			$error_val = array_values(json_decode(json_encode($validator->errors()), true));
		   return $error_val[0][0];
        }
    }

    public function addUser(Request $request)
    {
		$email_verified_code = rand(10000,99999);
		$status = 'active';
		if(isset($request->status)){
			$status = $request->status;
		}
       return User::create([
            "first_name"=>$request->first_name,
            "last_name"=>$request->last_name,
            "email"=>$request->email,
			"email_verified_code"=>$email_verified_code,
            "password"=> bcrypt($request->password),
			"status"=>$status,
        ]);
    }
	
	 public function userByIdOtp(Request $request,$type)
    {
        $users = User::where('id', $request->id)->where('email_verified_code', $request->code)->first();
		$cdate = date('Y-m-d H:i:s');
		$message = "error";
		$data = 'OTP code not matched';
		if($users){
			User::where('id', $request->id)->where('email_verified_code', $request->code)
                ->update(['email_verified_at' => $cdate]);
			$message = "success";
			$data = $type.' verify successfully';
		}
		return array("message"=>$message,"data"=>$data);
    }

    public function updateUser(Request $request, $userId)
{
    $user = User::find($userId);

    if (!$user) {
        return null;
    }

 
    $user->first_name = $request->first_name ?? $user->first_name;
    $user->last_name = $request->last_name ?? $user->last_name;
    // $user->email = $request->email ?? $user->email;
   
    $user->save();

    return $user;
}

public function updateAddress(Request $request, $userId)
{
    $address = UserAddress::where('user_id', $userId)->first();

    if (!$address) {
        return null;
    }

    $address->address = $request->streetAddress1 ?? $address->address;
    $address->street_name = $request->streetAddress2 ?? $address->street_name;
    $address->city = $request->city ?? $address->city;
    $address->province = $request->state ?? $address->province;
    $address->zipcode = $request->zipcode ?? $address->zipcode;
    $address->country = $request->country ?? $address->country;
    $address->save();

    return $address;
}


public function updateProfessional(Request $request, $userId)
{
    $professional = Professional::where('user_id', $userId)->first();

    if (!$professional) {
        return null;
    }

    $professional->interested_industry = $request->interested_industry ?? $professional->interested_industry;
    $professional->save();

    return $professional;
}


public function updateProfile(Request $request, $userId)
{
    $profile = UserProfile::where('user_id', $userId)->first();

    if (!$profile) {
        return null;
    }

    $profile->contact_no = $request->contact_no ?? $profile->contact_no;
    $profile->state_name = $request->state_name ?? $profile->state_name;
    $profile->about_me = $request->other ?? $profile->other;
    $profile->save();

    return $profile;
}

}