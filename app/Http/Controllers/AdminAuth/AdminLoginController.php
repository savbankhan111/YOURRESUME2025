<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use DB;
use Str;
use App\Models\Admin;
class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('adminauth.login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('admin.dashboard'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'))
				->withErrors(['invalid' => 'Incorrect email or password.']);				
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
	
	 public function adminPasswordRequest()
    {
        return view('adminauth.passwords.email');
    }
	
	 public function adPasswordRequest(Request $request,$token)
    {
        return view('adminauth.passwords.reset')->with(['token'=>$token,'email'=>$request->email]);
    }
	
	public function validatePasswordRequest (Request $request)
    {
       //You can add validation login here
		$user = DB::table('admins')->where('email', $request->email)->get();
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
		$user = DB::table('admins')->where('email', $email)->select('name', 'email')->first();
		//Generate, the password reset link. The token generated is embedded in the link
		$link = '/admin/ad-password/reset/'.$token.'?email='.urlencode($user->email);

		try {
		//Here send the link with CURL with an external email API 
		$mail_data = array('name' => $user->name,'email' => $email,'mess' => $link);
			Mail::send('emails.reset_password', $mail_data, function ($message) use ($email){
				$message->from('noreply@asecurity.com', 'A&S Security');
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

     $user = Admin::where('email', $tokenData->email)->first();
	 
     if ( !$user ){
		return redirect()->back()->withErrors(['error' => 'This password reset token is invalid.']);
	 }

     $user->password = bcrypt($password);
     $user->update(); 


    // If the user shouldn't reuse the token later, delete the token 
    DB::table('password_resets')->where('email', $user->email)->delete();

		return redirect()->route("admin.login")->with('success', 'Password reset successfully.');
	}
}