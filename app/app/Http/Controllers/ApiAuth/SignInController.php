<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use URL;
use Mail;
use DB;
use Str;
use App\User;
use App\Models\School;
use Illuminate\Support\Facades\Log;

class SignInController extends Controller{

	private $uploadPath = "public/uploads/";
	public function __invoke(Request $request)
	{
		$credentials = $this->validate($request, [
			"email" => "required",
			"password" => "required"
		]);
	
		if (!$token = auth('api')->attempt($credentials)) {
			return response()->json(["message" => "error", 'error' => 'Unauthorized'], 401);
		}
	
		// Get Authenticated User
		$user = auth('api')->user();
	
		return response()->json([
			'message' => 'success',
			'data' => [
				'access_token' => $token,
				'token_type' => 'bearer',
				'expires_in' => auth('api')->factory()->getTTL() * 60, // Default JWT expiry
				'user_id' => $user->id, // Pass user_id in response
			]
		]);
		
	}
	
public function me(Request $request)
{

	

    // Check if user_id exists in request
    if (!$request->has('user_id')) {
        return response()->json(["message" => "error", "error" => "user_id is required"], 400);
    }

    // Retrieve user by user_id
    $user = User::find($request->user_id);

    // Check if user exists
    if (!$user) {
        return response()->json(["message" => "error", "error" => "User not found"], 404);
    }

    $userData = $user->toArray();

    // Update Image URL if image exists
    if (!empty($user->image)) {
		
        $userData['image'] = URL::to('/' . $this->uploadPath . 'profile/' . $user->image);
    }

    // Get related data
    $roles = $user->roles[0]->roles ?? null;
    $profile = $user->userInfo ?? null;
    $address = $user->userAddress ?? null;
    $type = $user->professional ?? $user->student ?? null;
    $order = $user->userOrder ?? [];

    // Get school if student type exists
    $school = [];
    if (!empty($type) && isset($type->school_id)) {
        $school = School::find($type->school_id);
    }

    // Merge all data
    $response = [
        "message" => "success",
        "data" => array_merge($userData, [
            'profile' => $profile,
            'address' => $address,
            'user_type' => $roles,
            'type' => $type,
            'school' => $school,
            'orders' => $order
        ])
    ];

    return response()->json($response);
}


    //  public function me()
    // {
	   
    //     $user = auth()->user()->toArray();

	
	//    if($user['image']){
	// 	$user['image'] = URL::to('/'.$this->uploadPath.'profile/'.$user['image']);
	//    }
    //      $roles = auth()->user()->roles[0]->roles;
	// 	 $profile= auth()->user()->userInfo;
	// 	 $address= auth()->user()->userAddress;
	// 	 $type = auth()->user()->professional;
	// 	 $order = auth()->user()->userOrder;
	// 	 $school= array();
	// 	if(empty($type)){
	// 	  $type = auth()->user()->student;
	// 	 if(!empty($type->school_id)){
	// 		$school = School::where('id',$type->school_id)->first(); 
	// 	 }
	// 	}
	// 	$user = array_merge($user,array('profile'=>$profile,'address'=>$address));
	// 	$data = ["message"=>"success","data"=>array_merge($user,array('user_type'=>$roles,'type'=>$type,'school'=>$school,'orders'=>$order))];
    //     return response()->json($data);
    // }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
       auth()->logout();
      return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
      return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json(["message"=>"success",'data' => [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]]);
    }
	
	private function sendResetEmail($email, $token)
	{
		$user = User::where('email', $email)->select('first_name','last_name', 'email')->first();
		$link = '/password/reset/'.$token.'?email='.urlencode($user->email);
		try {
		 $mail_data = array('name' => $user->first_name,'email' => $email,'mess' => $link);
			Mail::send('emails.reset_password', $mail_data, function ($message) use ($email){
				$message->from('noreply@resumelive.com', 'ResumeLive');
				$message->to($email);
				$message->subject("Reset Password Notification");
			});
			return true;
		} catch (\Exception $e) {
			return false;
		}
	}
	
	public function forgetPassword(Request $request)
    {
		$user = User::where('email', $request->email)->select('id')->get();
		$data = array("message"=>"error");
		if (sizeof($user) < 1) {
			$data = array_merge($data,array('error'=>"We can't find a user with that e-mail address."));
		  return response($data, Response::HTTP_OK);
		}

		DB::table('password_resets')->insert([
			'email' => $request->email,
			'token' => Str::random(60)
		]);
		$tokenData = DB::table('password_resets')->where('email', $request->email)->first();

		if($this->sendResetEmail($request->email, $tokenData->token)){
			$data = array("message"=>"success","data"=>"A reset link has been sent to your email address.");
		} else {
			$data = array_merge($data,array('error'=>"A Network Error occurred. Please try again."));
		}			
		return response($data, Response::HTTP_OK);
    }
	
	public function resendMailVerify(Request $request)
    {
		$user = User::where('email', $request->email)->select('id','email_verified_at')->get();
		$data = array("message"=>"error");
		if (sizeof($user) < 1) {
			$data = array_merge($data,array('error'=>"We can't find a user with that e-mail address."));
		  return response($data, Response::HTTP_OK);
		}
		if(!empty($user[0]->email_verified_at)){
			$data = array_merge($data,array('error'=>"Your email address is already Verified."));
		  return response($data, Response::HTTP_OK);
		}
		$email_verified_code = rand(10000,99999);		
		User::where('email', $request->email)->update(["email_verified_code"=>$email_verified_code]);
		$user_data = User::where('email', $request->email)->first();	
		Mail::send('emails.verify_otp', ['user' => $user_data], function ($m) use ($user_data){
            $m->from('norpely@resumelive.com', 'ResumeLive');
            $m->to($user_data->email, $user_data->firstname)->subject('Verify email address!');
        });
		$data = array("message"=>"success","data"=>"Verification mail sent successfully.");				
	  return response($data, Response::HTTP_OK);
    }
}