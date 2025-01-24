<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\UserValidation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{

    public function index()
    {
        $view = 'admin/plans/plan_list';
        return view($view)
            ->with([
                'plans' => SubscriptionPlan::paginate(30)
            ]);
    }

    public function planDetails($pid)
    {
		$plan = SubscriptionPlan::where('id',$pid)->get();
      return view("admin/plans/plan_details", compact("plan"));
    }

    public function editPlan($pid)
    {
       $plan = SubscriptionPlan::where('id',$pid)->first();
      return view("admin/plans/plan_edit", compact("plan"));
    }
    
     public function detailsPlan($pid)
    {
       $user = SubscriptionPlan::where('id',$pid)->first();
      return view("admin/plans/details", compact("user"));
    }

    public function updatePlan(Request $request, $pid)
    {
        $request->validate([
				 'plan_name'=> 'required|min:2',
				 'interview_count'=>'required',
				 'day_limit'=> 'required',
				 'price'=> 'required'
                ]);
		SubscriptionPlan::where('id',$pid)->update([
			"plan_name"=>$request->plan_name,
			"detail"=>$request->detail,
			"plan_type"=>$request->plan_type,
			"plan_option"=>$request->plan_option,
            "interview_count"=>$request->interview_count,
			"day_limit"=>$request->day_limit,
			"price"=>$request->price,
			"status"=>$request->status,
          ]);
     return redirect()->route("admin.plans")->with('success',  Lang::get('adminmsgs.success'));
    }
    
       public function updateStatusPlan( $pid)
    {
       
		SubscriptionPlan::where('id',$pid)->update([
		
			"status"=>'0',
          ]);
      return redirect()->back()->with('success',  Lang::get('adminmsgs.success'));
    }
	
    public function addPlan()
    {
      return view("admin/plans/plan_create");
    }
	
    public function storePlan(Request $request)
    {
		$request->validate([
				 'plan_name'=> 'required|min:2',
				 'interview_count'=>'required',
				 'day_limit'=> 'required',
				 'price'=> 'required'
                ]);
		SubscriptionPlan::create([
			"plan_name"=>$request->plan_name,
			"detail"=>$request->detail,
			"plan_type"=>$request->plan_type,
			"plan_option"=>$request->plan_option,
            "interview_count"=>$request->interview_count,
			"day_limit"=>$request->day_limit,
			"price"=>$request->price,
			"status"=>$request->status,
          ]);		
      return redirect()->route("admin.plans")->with('success',  Lang::get('adminmsgs.success'));
    }
}