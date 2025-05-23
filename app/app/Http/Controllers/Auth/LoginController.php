<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Mail;
use DB;
use Str;
use App\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
	 
	  public function redirectTo()
    {
		 $user = Auth::user();
		
		if($user->roles[0]->id == 2 && substr($user->employerInfo->expire_ac,0,10 ) >= date('Y-m-d') ) {
           return 'crm';
        }elseif ($user->checkRole("interviewer_manager")){
            return 'interviewsdata';
        } else {
            
			Auth::logout();
		   return '/login?active=Account Expired';
		}
    }
    //protected $redirectTo = RouteServiceProvider::HOME; //'school'; 
	//RouteServiceProvider::HOME;
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    }
	
 public function login(Request $request) {
    $this->validateLogin($request);

    // This section is the only change
    if ($this->guard()->validate($this->credentials($request))) {
       
        $user = $this->guard()->getLastAttempted();

    
        // Make sure the user is active
        if ($user->status == 'active' && $this->attemptLogin($request)) {
            // Send the normal successful login response
            return $this->sendLoginResponse($request);
        } else {
            // Increment the failed login attempts and redirect back to the
            // login form with an error message.
            $this->incrementLoginAttempts($request);
            return redirect()
                ->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors(['active' => 'You must be active to login.']);
        }
    }

    // If the login attempt was unsuccessful we will increment the number of attempts
    // to login and redirect the user back to the login form. Of course, when this
    // user surpasses their maximum number of attempts they will get locked out.
    $this->incrementLoginAttempts($request);

    return $this->sendFailedLoginResponse($request);
 }
 
  public function PasswordRequest()
    {
        return view('auth.passwords.email');
    }
	
	public function validatePasswordRequest (Request $request)
    {
       //You can add validation login here
		$user = DB::table('users')->where('email', $request->email)->get();
		//Check if the user exists
		if (sizeof($user) < 1) {
			return redirect()->back()->withErrors(['email' => "We can't find a user with that e-mail address."]);
		}

		//Create Password Reset Token
		DB::table('password_resets')->insert([
			'email' => $request->email,
			'token' => Str::random(60),
			//'created_at' => Carbon::now()
		]);
		//Get the token just created above
		$tokenData = DB::table('password_resets')->where('email', $request->email)->first();

		if ($this->sendResetEmail($request->email, $tokenData->token)) {
			return redirect()->back()->with('status', 'A reset link has been sent to your email address.');
		} else {
			return redirect()->back()->withErrors(['error' => 'A Network Error occurred. Please try again.']);
		}			
    }
	
	private function sendResetEmail($email, $token)
	{
		//Retrieve the user from the database
		$user = DB::table('users')->where('email', $email)->select('first_name','last_name', 'email')->first();
		//Generate, the password reset link. The token generated is embedded in the link
		$link = '/password/reset/'.$token.'?email='.urlencode($user->email);

		try {
		//Here send the link with CURL with an external email API 
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
	
	public function PasswordsReset(Request $request)
	{
		 $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
			'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',			
        ]);
		
		  $password = $request->password;
     $tokenData = DB::table('password_resets')->where('email', $request->email)->where('token', $request->token)->first();

     $user = User::where('email', $tokenData->email)->first();
	 
     if ( !$user ){
		return redirect()->back()->withErrors(['error' => 'This password reset token is invalid.']);
	 }

     $user->password = bcrypt($password);
     $user->update(); 


    // If the user shouldn't reuse the token later, delete the token 
    DB::table('password_resets')->where('email', $user->email)->delete();

		return redirect()->route("login")->with('success', 'Password reset successfully.');
	}
	
}
