<?php
namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Student;
use App\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class CronController extends Controller{
    public function changeStudentStatus(Request $request){		
		$cur_date = date('Y-m-d');
        $student = Student::where('graduation', $cur_date)->select('user_id')->get()->toArray();
		 User::whereIn('id', $student)->update(["status"=>'pending']);
        return 1;
    }	
}