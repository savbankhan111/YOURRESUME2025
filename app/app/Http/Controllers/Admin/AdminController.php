<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class AdminController extends Controller
{
    public function dashboard(){
        $stuTotals = Role::where("id", 1)
             ->withCount("users")->withCount("userActiveTotal")
             ->withCount("userDisabledTotal")->withCount("userPendingTotal")
             ->first();
        $empTotals = Role::where("id", 2)
            ->withCount("users")->withCount("userActiveTotal")
             ->withCount("userDisabledTotal")->withCount("userPendingTotal")
            ->first();
		$profTotals = Role::where("id", 3)
            ->withCount("users")->withCount("userActiveTotal")
             ->withCount("userDisabledTotal")->withCount("userPendingTotal")
            ->first();
		$mangTotals = Role::where("id", 4)
            ->withCount("users")->withCount("userActiveTotal")
             ->withCount("userDisabledTotal")->withCount("userSuspendTotal")
            ->first();	
        return view("admin.dashboard", compact("stuTotals","empTotals","profTotals","mangTotals"));
    }

    public function profile(){
        return view("admin.admin_profile");
    }
    public function updateProfile(Request $request){
        $userid = Auth::user()->id;
        $data = Admin::findOrFail($userid);
        $this->validate($request, [
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|unique:admins,email,'.$userid
        ]);
      	if(!empty($request->image)){			
            $request->validate(['image' => 'mimes:png,jpeg,jpg,gif']);
            $fileFinalName = 'job_'.time().rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $path = 'public/images/';
            $request->file('image')->move($path, $fileFinalName);
            $data['image'] = $fileFinalName;
         }	
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        if ($request->newpassword != null || $request->oldpassword != null){
            $this->validate($request, [
                 'oldpassword' => 'required|min:6',
                 'newpassword' => 'required|min:6',
        ]);

            if (Hash::check($request->oldpassword, $data->password)) {
                $data['password'] = Hash::make($request['newpassword']);
            }else{
                return redirect()->back()->with('error', Lang::get('adminmsgs.error_password'));
            }
        }
         $data->save();
        return redirect()->back()->with('success',  Lang::get('adminmsgs.profile_update'));


    }
}