<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\GroupUser;
use App\Models\Student;
use App\Services\AuthService;
use App\User;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller{
	
	public function registerStudent(Request $request, AuthService $authService){
		 $type = 'student';
		 $data = array("message"=>"error");
         $val_error = $authService->validationAll($request, $type);
		if($val_error){
			$data = array_merge($data,array('error'=>$val_error));
		  return response($data, Response::HTTP_OK);
		}
		 $request->school_id = null;
		if(!empty($request->school_code)){
          $school = School::where("school_code",$request->school_code)->first();
		  if(!$school){
			  $data = array_merge($data,array('error'=>'School code is not available. Please check your school code.'));		   
			return response($data, Response::HTTP_OK);
		  }
		   $request->school_id = $school->id;	
		   $request->school_name= null;	   
		} else {
		 if(empty($request->school_name)){	
		  $data = array_merge($data,array('error'=>'School Name is required.'));		   
		 return response($data, Response::HTTP_OK);  
		 }		 
		}
		$role_id = 1;
        $user = $authService->addUser($request);
		$userAddress= $authService->addAddress($request, $user->id);
        $userType = $authService->addStudent($request, $user->id);
		$userInfo = $authService->addProfile($request, $user->id); 
        $user->roles()->attach($role_id); // student		
        $user->userAddress = $userAddress;
 	    $user->userType = $userType;
		$user->userInfo = $userInfo;	
		$data = array("message"=>"success","data"=>$user);
		// Mail::send('emails.verify_otp', ['user' => $user], function ($m) use ($user) {
        //     $m->from('norpely@res.com', 'Resume Live');
        //     $m->to($user->email, $user->firstname)->subject('Verify email address!');
        // });
	  return response($data, Response::HTTP_OK);
    }
	
	public function registerProfessional(Request $request, AuthService $authService){
		 $type = 'professional';
		 $data = array("message"=>"error");
         $val_error = $authService->validationAll($request, $type);
		if($val_error){
			$data = array_merge($data,array('error'=>$val_error));
		  return response($data, Response::HTTP_OK);
		}
		
		$role_id = 3;
        $user = $authService->addUser($request);
		$userAddress = $authService->addAddress($request, $user->id);
		$userType = $authService->addProfessional($request, $user->id); 
		$userInfo = $authService->addProfile($request, $user->id); 
        $user->roles()->attach($role_id);
        
		$user->userAddress = $userAddress;
 	    $user->userType = $userType;
		$user->userInfo = $userInfo;
		$data = array("message"=>"success","data"=>$user);
		// Mail::send('emails.verify_otp', ['user' => $user], function ($m) use ($user) {
        //     $m->from('norpely@resumelive.com', 'Resume Live');
        //     $m->to($user->email, $user->first_name)->subject('Verify email address!');
        // });
	  return response($data, Response::HTTP_OK);
    }
	

	public function updateProfessional(Request $request, AuthService $authService)
{
    $type = 'professional';
    $data = ["message" => "error"];

    // Validate incoming request
    // $val_error = $authService->validationAll($request, $type);
    // if ($val_error) {
    //     $data = array_merge($data, ['error' => $val_error]);
    //     return response($data, Response::HTTP_OK);
    // }

    // Check if user exists
    $user = User::find($request->id);
    if (!$user) {
        return response()->json([
            "message" => "User not found.",
            "error" => true
        ], Response::HTTP_NOT_FOUND);
    }

   
    $user = $authService->updateUser($request, $user->id);

   
    $userAddress = $authService->updateAddress($request, $user->id);


    $userType = $authService->updateProfessional($request, $user->id);

    
    $userInfo = $authService->updateProfile($request, $user->id);

    // Attach updated details to user object
    $user->userAddress = $userAddress;
    $user->userType = $userType;
    $user->userInfo = $userInfo;

    // ✅ Return success response
    $data = [
        "message" => "success",
        "data" => $user
    ];

    return response($data, Response::HTTP_OK);
}

    public function verify(Request $request, $type, AuthService $authService){
		$data = array();
		if ($type == "mail"){
		  $data = $authService->userByIdOtp($request,$type);	
		}
		return response($data, Response::HTTP_OK);
	}		
}