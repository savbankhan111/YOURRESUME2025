<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Chat;
use App\Models\Role;
use App\Models\Order;
use App\Models\State;
use App\Models\Country;
use App\Models\Student;
use App\Events\GroupChat;
use App\Models\School;
use Mail;
use App\Models\Industry;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\UserValidation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class UsersListController extends Controller
{

    // public function userListBy(Request $request, $name, UserService $emp)
    // {
       
    //     $candidates = $emp->empList($request, $name);
    //     $view = 'admin/userlist/users_list';
    //     //where('status', 'active')->
    //     $option = 'direct';
    //     if ($name == 'non-student') {
    //         $option = 'non';
    //     }
    //     $schools = School::where('school_type', $option)->get();
    //     return view($view)
    //         ->with([
    //             'candidates' => $candidates->paginate(30),
    //             'roles' => Role::all(),
    //             'schools' => $schools
    //         ]);
    // }
    public function userListBy(Request $request, $name, UserService $emp)
{
    // Get candidates list using empList
    $candidates = $emp->empList($request, $name);

    // Determine school type based on user type
    $option = ($name == 'non-student') ? 'non' : 'direct';

    // Fetch schools based on type
    $schools = School::where('school_type', $option)->get();
// dd($candidates);
    // Return view with data
    return view('admin/userlist/users_list', [
        'candidates' => $candidates->paginate(30), // Paginate the results
        'roles' => Role::all(),
        'schools' => $schools,
    ]);
}


    public function userDetails(User $user)
    {
        return view("admin/userlist/user_details", compact("user"));
    }

    public function editUser(User $user)
    {
        $country = Country::where('id', 231)->get();
        $state = State::where('country_id', 231)->get();
        $schools = User::where('status', 'active')->whereHas('roles', function ($query) {
            $query->where('roles.id', 4);
        })->get();
        return view("admin/userlist/user_edit", compact("user", "schools", "country", "state"));
    }

    public function updateUser(UserValidation $request, User $user, UserService $userService)
    {
        $save_data = $userService->userUpdate($request, $user);
        return redirect()->back()->with('success',  Lang::get('adminmsgs.success'));
        //route("admin.userEdit",$user->id)->
    }

    public function editStudent(User $user)
    {
        $country = Country::where('id', 231)->get();
        $state = State::where('country_id', 231)->get();
        $option = 'non';
        if (!empty($user->student->school_id)) {
            $option = $user->student->school->school_type;
        }
        $schools = School::where('school_type', $option)->get();
        return view("admin/userlist/student_edit", compact("user", "schools", "country", "state"));
    }

    public function userDelete(Request $request, $userId, UserService $emp)
    {
        $emp->userDestroy($request, $userId);
        return redirect()->back()->with("success", Lang::get('adminmsgs.delete'));
    }
    public function changeUserStatus(Request $request, $userId)
    {
        $user =  User::find($userId);
        $user->status = $request->status;
        $user->save();
$emaails=$user->email;
		try {
		 $mail_data = array('name' => $user->first_name,'email' => $user->email,'mess' => 'Your account is '.$request->status.' If you have any question, please contact us.');
			\Mail::send('emails.status', $mail_data, function ($message) use ($emaails){
				$message->from('noreply@resumelive.com', 'ResumeLive');
				$message->to($emaails);
				$message->subject("Account Status");
			});
			
		} catch (\Exception $e) {
		
		}
        return redirect()->back()->with("success", Lang::get('adminmsgs.status_updated'));
    }
    
     public function changeUserStatuss($userId)
    {
        
        $user =  User::find($userId);
        $user->status = 'deactivate';
        $user->save();
        $emaailsd = $user->email;
     
        	try {
        	    
		 $mail_data = array('name' => $user->first_name,'email' => $user->email,'mess' => 'Your account has been deactivated. If this is not correct, please contact us.

We are disappointed to see you leave and hope that you will return soon.');
		 
			\Mail::send('emails.status', $mail_data, function ($message) use ($emaailsd){
				$message->from('noreply@resumelive.com', 'ResumeLive');
				$message->to($emaailsd);
				$message->subject("Account Status");
			});

		
		} catch (\Exception $e) {
			 
		}
        return redirect()->back()->with("success", Lang::get('adminmsgs.status_updated'));
    }
	
    public function changeSchoolStatus(Request $request, $id)
    {
        $user =  School::find($id);
        $user->status = $request->status;
        $user->save();
        return redirect()->back()->with("success", Lang::get('adminmsgs.status_updated'));
    }
	
    public function schoolListBy(Request $request, UserService $emp)
    {
        $candidates = $emp->empSchool($request, 'direct');
        $view = 'admin/schoolist/school_list';
        return view($view)
            ->with([
                'candidates' => $candidates->paginate(30)
            ]);
    }

    public function schoolDetails(School $user)
    {
        return view("admin/schoolist/school_details", compact("user"));
    }
    public function addSchool()
    {

        $country = Country::where('id', 231)->get();
        $state = State::where('country_id', 231)->get();
        return view("admin/schoolist/school_create", compact("country", "state"));
    }
    public function storeSchool(Request $request, UserService $userService)
    {
        $userService->schoolStore($request);
        return redirect()->route("admin.schoolListBy", "status=" . $request->status)->with('success',  Lang::get('adminmsgs.success'));
    }

    public function addNonSchool()
    {

        $country = Country::where('id', 231)->get();
        $state = State::where('country_id', 231)->get();
        return view("admin/schoolist/non_school_create", compact("country", "state"));
    }
    public function storeNonSchool(Request $request, UserService $userService)
    {
        $userService->schoolStore($request);
        return redirect()->route("admin.nonSchoolListBy", "status=" . $request->status)->with('success',  Lang::get('adminmsgs.success'));
    }

    public function nonSchoolListBy(Request $request, UserService $emp)
    {
        $candidates = $emp->empSchool($request, 'non');
        $view = 'admin/schoolist/non_school_list';
        return view($view)
            ->with([
                'candidates' => $candidates->paginate(30)
            ]);
    }

    public function nonSchoolDetails(School $user)
    {
        return view("admin/schoolist/school_details", compact("user"));
    }

    public function storePayment(Request $request, $id)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date'  => 'required',
            'token_id'  => 'required',
            'total_amount' => 'required',
        ]);

        Order::create([
            'group_code_id' => $id,
            "from_date" => date('Y-m-d', strtotime($request->from_date)),
            "to_date" => date('Y-m-d', strtotime($request->to_date)),
            "payment_type" => 'admin',
            "token_id" => $request->token_id,
            "total_amount" => $request->total_amount
        ]);
        return redirect()->back()->with('success',  Lang::get('adminmsgs.success'));
        //redirect()->route("admin.schoolDetails",$user_id)->with('success',  Lang::get('adminmsgs.success'));
    }
    public function paymentDelete(Request $request, $payId)
    {
        Order::where('id', $payId)->delete();
        return redirect()->back()->with("success", Lang::get('adminmsgs.delete'));
    }
    public function editSchool($user)
    {
        $country = Country::where('id', 231)->get();
        $state = State::where('country_id', 231)->get();
		$user = School::where('id', $user)->first();
        return view("admin/schoolist/school_edit", compact("user", "country", "state"));
    }
    public function editNonSchool($user)
    {
        $country = Country::where('id', 231)->get();
        $state = State::where('country_id', 231)->get();
		$user = School::where('id', $user)->first();
        return view("admin/schoolist/school_edit", compact("user", "country", "state"));
    }
    public function updateSchool(Request $request, $user, UserService $userService)
    {
        $request->validate(['school_code' => 'required']);
        $chk_code = School::where('id', '!=', $user)->where('school_code', $request->school_code)->first();
        if ($chk_code) {
            return redirect()->back()->withErrors(['The School Code has already been taken.'])->withInput();
        }
        $userService->schoolUpdate($request, $user);
        return redirect()->back()->with('success',  Lang::get('adminmsgs.success'));
        //->route("admin.editSchool",$user->id)
    }

    public function userProfilePicUpdate(UserFile $request, User $user)
    {
        //Setting folder for document files
        $request->folder = profileImages;
        //uploading documents
        $document = uploadToStorage($request, file, $user->id);
        if (!empty($user->profile->profile_image)) {
            ___delete($user->profile->getOriginal()[profile_image]);
        }
        $user->profile->update([
            profile_image => $document[file]
        ]);
        return redirect()->back()->with("success", trans('messages.PROFILE_IMAGE_UPDATED'));
    }

    public function managerListBy(Request $request,  UserService $emp)
    {
        $name = 'interviewer_manager';
        $candidates = $emp->empList($request, $name);
        $view = 'admin/manager/manager_list';
        return view($view)
            ->with([
                'candidates' => $candidates->paginate(30),
                'roles' => Role::all()
            ]);
    }

  
  
    public function managerDetails(User $user)
    {
        return view("admin/manager/manager_details", compact("user"));
    }
    public function addManager()
    {
		$industry = Industry::get();
        $country = Country::where('id', 231)->get();
        $state = State::where('country_id', 231)->get();
        return view("admin/manager/manager_create", compact("industry","country", "state"));
    }
    public function storeManager(Request $request, UserService $userService)
    {
        $userService->managerStore($request);
        return redirect()->route("admin.managerListBy", "status=" . $request->status)->with('success',  Lang::get('adminmsgs.success'));
    }
    public function editManager(User $user)
    {  
		$industry = Industry::get();
        $country = Country::where('id', 231)->get();
        $state = State::where('country_id', 231)->get();
        return view("admin/manager/manager_edit", compact("user", "country", "state","industry"));
    }

    public function updateManager(Request $request, User $user, UserService $userService)
    {
        $userService->updateManager($request, $user);
        return redirect()->route("admin.editManager", $user->id)->with('success',  Lang::get('adminmsgs.success'));
    }

   public function employerListBy(Request $request, UserService $emp)
    {
        $name = 'employer';
        $candidates = $emp->empList($request, $name);
        $view = 'admin/employer/employer_list';
        return view($view)
            ->with([
                'candidates' => $candidates->paginate(30),
                'roles' => Role::all()
            ]);
    }
    
      public function detailsEmployer(User $user)
    {
        return view("admin/employer/employer_details", compact("user"));
    }
  
    public function addEmployer()
    {
        $country = Country::where('id', 231)->get();
        $state = State::where('country_id', 231)->get();
        return view("admin/employer/employer_create", compact("country", "state"));
    }
    
    public function storeEmployer(Request $request, UserService $userService)
    {
        $userService->employerStore($request);
        return redirect()->route("admin.employerListBy", "status=" . $request->status)->with('success',  Lang::get('adminmsgs.success'));
    }
    public function editEmployer(User $user)
    {  
        $country = Country::where('id', 231)->get();
        $state = State::where('country_id', 231)->get();
        return view("admin/employer/employer_edit", compact("user", "country", "state"));
    }

    public function updateEmployer(Request $request, User $user, UserService $userService)
    {
        $userService->updateEmployer($request, $user);
        return redirect()->route("admin.editEmployer", $user->id)->with('success',  Lang::get('adminmsgs.success'));
    }

    public function chat($alertId)
    {
        $userId = Auth::user()->id;
        return view("admin/chat", compact("alertId", "userId"));
    }

    public function sentMessage(Request $request, $alertId)
    {
        $chat = Chat::create($request->all());

        $message = Chat::where("id", $chat->id)->with("users")->first();

        event(new GroupChat($alertId, $message));
    }
}
