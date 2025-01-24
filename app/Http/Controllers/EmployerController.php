<?php
namespace App\Http\Controllers;

//use App\Http\Requests\UserValidation;
use App\Models\JobSpareType;
use App\Models\Employer;
use App\Models\UserAddress; 
use App\Models\Job;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Services\JobProjectService;
use App\Models\State;
use App\Models\Country;
use App\Models\Industry;
use App\Models\Skill;
use App\Models\SkillField;
use App\Models\Language;
use App\Models\Role;
use App\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class EmployerController extends Controller{
	private $uploadPath = "public/uploads/";
   
    public function dashbords(){
        	$curr_user = Auth::user();
		$totaljobs = Job::where('created_by',$curr_user->id)->count();
	    $activejobs = Job::where('created_by',$curr_user->id)->where('status','publish')->where('job_status','open')->count();
	    $closejobs = Job::where('created_by',$curr_user->id)->where('job_status','close')->count();
	     $pendingjobs = $totaljobs-($activejobs+$closejobs);
        return view("employer/dashboardss")
            ->with(['totaljobs'=> $totaljobs,'activejobs'=>$activejobs,'closejobs'=>$closejobs,'pendingjobs'=>$pendingjobs]);
    }

   public function jobListBy(Request $request, JobProjectService $job){
		$curr_user = Auth::user();
		$jobs = $job->jobList($request,$curr_user->id);
        return view("employer/job_list")
            ->with(['jobs'=> $jobs->paginate(30)]);
    }

	
	public function profile(){
		$country = Country::where('id',231)->get();		
		$state = State::where('country_id',231)->get();
		$user = Auth::user();
        return view("employer.my_profile")->with(['user'=>$user,'country'=>$country,'state'=>$state]);
    }
	
    public function updateProfile(Request $request){
        $user = Auth::user();
        $data = User::findOrFail($user->id);
		
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$user->id
        ]);
		if ($request->password != "") {
			$request->validate(['password'=> 'min:8']);
        }
		 if ($request->password != "") {
            $data['password'] = bcrypt($request->password);
         }
		 if(!empty($request->image)){			
            $request->validate(['image' => 'mimes:png,jpeg,jpg,gif']);
            $fileFinalName = 'job_'.time().rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $path = 'public/images/';
            $request->file('image')->move($path, $fileFinalName);
            $data['image'] = $fileFinalName;
         }	
		 
		$data['first_name']= $request->first_name;
		$data['last_name']= $request->last_name;
		//$data->status = $request->status;	
        $data->save();
		 $companyLogoName = null;
		if(!empty($request->company_logo)){
            $companyLogoName = time().rand(1111,9999).'.'.$request->file('company_logo')->getClientOriginalExtension();
            $path = $this->uploadPath.'profile/company/';
            $request->file('company_logo')->move($path, $companyLogoName);
        }
		
		Employer::where('user_id', $user->id)
              ->update([
				"phone_number" => $request->phone_number,
				"fax" =>$request->fax,
				"company_name"=>$request->company_name,
				"company_logo"=>$companyLogoName,
				"company_strength"=>$request->company_strength
			  ]);	
		UserAddress::where('user_id', $user->id)
              ->update(["address" => $request->address,"city" =>$request->city,"province" =>$request->state,"country" =>$request->country]);
        return redirect()->back()->with('success',  Lang::get('adminmsgs.profile_update'));
    }
	
	 public function addJob(){
		$employment_type = JobSpareType::where('type','employment_type')->get();
		$skill = Skill::get();
			$industry = Industry::get();
        return view("employer.job_add", compact("employment_type","skill","industry"));
    }

	 public function storeJob(Request $request,JobProjectService $job)
    {

		$user = Auth::user();
		$job->jobStore($request,$user->id);
     
        return redirect()->route("employer.jobListBy")->with('success',  Lang::get('adminmsgs.success'));
    }	

    public function jobDetail(Job $job)
    {
         return view("employer.job_detail", compact("job"));
     
    }

    public function editJob(Job $job){
		$employment_type = JobSpareType::where('type','employment_type')->get();
		$skill = Skill::get();
		$skillField = SkillField::where('job_id',$job->id)->get();
			$industry = Industry::get();
        return view("employer.job_edit", compact("job","employment_type","skill","skillField","industry"));
    }

 	 public function jobSetTrash($job_id)
    {	$request=array();
        $request['job_status']="trash";
		$job->jobUpdate($request,$job_id);
      return redirect()->back()->with('success',  Lang::get('adminmsgs.success'));
    }




	 public function jobUpdate(Request $request,$job_id,JobProjectService $job)
    {	
		$job->jobUpdate($request,$job_id);
      return redirect()->back()->with('success',  Lang::get('adminmsgs.success'));
    }

    public function jobDelete(Request $request, $job)
    {
        return redirect()->back()->with("success",Lang::get('adminmsgs.status_updated'));
    }

    public function changeJobStatus(Request $request, $job){
        $job = Job::find($job);
        if($request->status==""){
            $request->status="trash";
        }
        $job->status=$request->status;
        $job->save();
        return redirect()->back()->with("success",Lang::get('adminmsgs.status_updated'));
    }
	
	public function projectListBy(Request $request, JobProjectService $project){
		$curr_user = Auth::user();
		$projects = $project->projectList($request,$curr_user->id);
        return view("employer/project_list")
            ->with(['projects'=> $projects->paginate(30)]);
    }
	public function addProject(){
        return view("employer.project_add");
    }

	 public function storeProject(Request $request,JobProjectService $project)
    {
		$user = Auth::user();
		$project->projectStore($request,$user->id);
        return redirect()->route("employer.projectListBy")->with('success',  Lang::get('adminmsgs.success'));
    }
	public function changeProjectStatus(Request $request, $project){
        $project = Project::find($project);
        $project->status=$request->status;
        $project->save();
        return redirect()->back()->with("success",Lang::get('adminmsgs.status_updated'));
    }
	
	 public function editProject(Project $project){
        return view("employer.project_edit", compact("project"));
    }

	 public function projectUpdate(Request $request,$project_id,JobProjectService $project)
    {	
		$project->projectUpdate($request,$project_id);
      return redirect()->back()->with('success',  Lang::get('adminmsgs.success'));
    }
	
	 public function studentFilter(Request $request)
    { 
	  $langs = Language::Get();
	  $users = array();
	 return view("employer.student_filter", compact("langs","users"));
    }
	
	public function projectMembers($id){
		$curr_user = Auth::user();
		$project = Project::where('id',$id)->where("created_by",$curr_user->id)->select('id')->first();
	  if(!$project){
		  return redirect()->back();
	  }	
		$project_members = ProjectUser::where('project_id',$id)->paginate(30);	  
        return view("employer/project_members")
            ->with(['project_members'=> $project_members]);
    }
	public function pmRemove($pid,$id){
		$curr_user = Auth::user();
		$project = Project::where('id',$pid)->where("created_by",$curr_user->id)->select('id')->first();
	  if(!$project){
		  return redirect()->back();
	  }	
		$project_members = ProjectUser::where('id',$id)->delete();
         return redirect()->back()->with("success",Lang::get('adminmsgs.status_updated'));
    }
    
    
    
      public function applications(Request $request, $job_id)
    {
        $apps = Job::where("id", $job_id)->first();
       $applications = $apps->users()->filter($request->all())->paginate(20);;
       $projects = Project::where("created_by", Auth::id())->get();

        $skiils = SkillField::where("job_id", $apps->id)->with("skillData")->get();
       $langs = Language::all();

       return view("employer/applications_list")
            ->with(['apps'=> $applications, "job_id" => $job_id,"projects" => $projects, "langs" => $langs, "skills" => $skiils]);
    }


    public function addUserInProject(Request $request)
    {
        $validator = $request->validate([
            'projectId' => 'required',
            'userId' => 'required',
        ]);

       $project = Project::where("id", $request->projectId)
           ->where("created_by", Auth::id())
           ->first();

       $checkUser = ProjectUser::where("project_id", $project->id)
           ->where("user_id", $request->userId)->first();

       if (is_null($checkUser)){
        ProjectUser::create([
            "project_id" => $request->projectId,
            "user_id" => $request->userId
        ]);
       }else{
           return redirect()->back()->with("error","Already user present");
       }
        return redirect()->back()->with("success","Add User in Project Successfully");
    }

    public function jobUserDetails($user_id)
    {
        $user = User::where("id", $user_id);
        $applications = $user->resumeUserData()->first();
        
      
        
        
        $projects = Project::where("created_by", Auth::id())->get();
       /* echo "<pre>";
        print_r($applications->language);die;*/
        

        return view("employer/applications_single")
            ->with(['apps'=> $applications,"projects" =>$projects]);
    }
    
    
      public function byUserIdGetTables($user_id): array
    {
        $resume = UserResume::where("user_id", $user_id)->with("language")->first();
        $experience = Experience::where("user_id", $user_id)->get()->toArray();
        $skills = SkillField::where("type", "user")->where("job_id", $user_id)->with("skillData")->get()->pluck("skillData");
        $transcript = UserDocuments::where("type", "transcript")->where("user_id", $user_id)->get();
        $recommendationletter = UserDocuments::where("type", "reccom_letter")->where("user_id", $user_id)->get();
        $school = SchoolData::where("user_id", $user_id)->get();
        
        return array($resume, $experience, $skills, $transcript, $recommendationletter, $school);
    }
    
    
    
     public function applications_all(Request $request)
    {
        $applications = $this->allStudents($request);
        $projects = Project::where("created_by", Auth::id())->get();

        $skiils = SkillField::with("skillData")->get();
        $langs = Language::all();

        return view("employer/applications_list_all")
            ->with(['apps'=> $applications, "projects" => $projects, "langs" => $langs, "skills" => $skiils]);
    }

      public function allStudents(Request $request)
    {
        $applications = Role::where("roles", "student")->first()->users()
            ->filter($request->all())->paginate(20);;
        return $applications;
    }
    
}
