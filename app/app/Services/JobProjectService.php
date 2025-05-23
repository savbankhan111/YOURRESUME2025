<?php

namespace App\Services;
use App\Models\Role;
use App\Models\Job;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SkillField;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use DB;
class JobProjectService{
	private $uploadPath = "public/public/uploads/";
    // public function jobList(Request $request,$user_id=null)
    // {			
    //     $searchval= $request->query('search');
    //     $status= $request->query('status');
    //     $date = $request->query('date');
	// 	$job_status= $request->query('job_status');
	// 	$employment_type = $request->query('job_type');
	// 	if(!isset($status)){
	// 	  $status=  $request->status;
	// 	}
    //   	if(!isset($job_status)){
	// 	  $job_status=  $request->job_status;
	// 	}
      
    //     $jobs = null;
	// 	  if(isset($status)){
	// 		$jobs = Job::where('status', $status);
	// 	  }else{
	// 		$jobs = Job::where('status','!=','trash');
	// 	  }
	// 	if(isset($job_status) && !empty($job_status)){
	// 	  $jobs->where('job_status', $job_status);		
	// 	}else{
		    
	// 	}
		
	// 	if(isset($employment_type) && !empty($employment_type)){
	// 	  $jobs->where('employment_type_id', $employment_type);		
	// 	}			
    //     if(!empty($user_id)){
	// 		$jobs->where('created_by', $user_id);	
	// 	}
    //     if ($request->query('date')  != null && $request->query('date') != "change"){
    //         $jobs->where('created_at', '>=', $date);
    //     }
    //     return $jobs->latest();
    // }

    // public function getActiveUser(Request $request,$user_id=null)
    // {
        
    //     $data= $this->jobList($request,$user_id)->whereHas("user", function($q){
    //     $q->where("status", "active");
    //       })->whereHas("empData", function($q){
    //         $q->where("expire_ac", ">", NOW());
    //     });
        
    //     if(!empty($request->max_salery)){
    //         $data=$data->where('min_salary','>',$request->min_salery)->where('max_salary','<',$request->max_salery);
    //     }
    //     return $data;
    // }
	public function jobList(Request $request, $user_id = null)
{
    $searchval = $request->query('searchdata');
    $status = $request->query('status');
    $date = $request->query('date');
    $job_status = $request->query('job_status');
    $employment_type = $request->query('job_type');

    if (!isset($status)) {
        $status = $request->status;
    }
    if (!isset($job_status)) {
        $job_status = $request->job_status;
    }

    $jobs = null;
    if (isset($status)) {
        $jobs = Job::where('status', $status);
    } else {
        $jobs = Job::where('status', '!=', 'trash');
    }

    if (isset($job_status) && !empty($job_status)) {
        $jobs->where('job_status', $job_status);
    }

    if (isset($employment_type) && !empty($employment_type)) {
        $jobs->where('employment_type_id', $employment_type);
    }

    if (!empty($user_id)) {
        $jobs->where('created_by', $user_id);
    }


    if (!empty($searchval)) {
        $jobs->where(function ($q) use ($searchval) {
            $q->where('title', 'LIKE', "%$searchval%")
                ->orWhere('description', 'LIKE', "%$searchval%")
                ->orWhere('location', 'LIKE', "%$searchval%");
        });
    }

    if ($request->query('date') != null && $request->query('date') != "change") {
        $jobs->where('created_at', '>=', $date);
    }

    return $jobs->latest();
}

public function getActiveUser(Request $request, $user_id = null)
{
    $data = $this->jobList($request, $user_id)
        ->whereHas("user", function ($q) {
            $q->where("status", "active");
        })
        ->whereHas("empData", function ($q) {
            $q->where("expire_ac", ">", NOW());
        });

   
		// if (!empty($request->max_salary)) {
		// 	$data = $data->where('max_salary', '<=', $request->max_salary);
		// }
		
		if (!empty($request->max_salary)) {
			$data = $data->where('max_salary', '>=', $request->max_salary);
		}
		

    return $data;
}

	
 public function getfavouriteActiveUser(Request $request,$user_id=null)
    {
        
         $data= Job::join('job_favs','job_favs.job_id','=','jobs.id')->where('job_favs.user_id',$request->id)->where('jobs.status', 'publish ')->whereHas("user", function($q){
        $q->where("status", "active");
          })->whereHas("empData", function($q){
            $q->where("expire_ac", ">", NOW());
        });
        
        if(!empty($request->searchdata)){
			$searr=$request->searchdata;
            $data=$data->where(function ($query) use ($searr) {
				$query->where('title',"like","%".$request->searchdata."%")->orWhere('description',"like","%".$request->searchdata."%")->orWhere('position',"like","%".$request->searchdata."%")->orWhere('responsibilty',"like","%".$request->searchdata."%")->orWhere('location',"like","%".$request->searchdata."%");
			});
	
        }
		$data->select('jobs.*');
        
        return $data;
    }
	
	public function skillStore($name){
	  return Skill::create(['name'=> $name]);
	}
	
	public function jobStore(Request $request,$user_id){
		 $request->validate([
				 'company'=> 'required|min:2',
				 'responsibilty'=> 'required'
                ]);
		 $fileFinalName = null;  
		if(!empty($request->image)){			
            $request->validate(['image' => 'mimes:png,jpeg,jpg,gif']);
            $fileFinalName = 'job_'.time().rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $path = $this->uploadPath.'jobs/';
            $request->file('image')->move($path, $fileFinalName);
        }	
        $jobVideoName="";
		if(!empty($request->job_video)){			
            //$request->validate(['job_video' => 'mimes:png,jpeg,jpg,gif']);
            $jobVideoName = 'jobv_'.time().rand(1111,9999).'.'.$request->file('job_video')->getClientOriginalExtension();
            $path = $this->uploadPath.'jobs/videos/';
            $request->file('job_video')->move($path, $jobVideoName);
        }
		$job = Job::create([
					"title"=>$request->company, //company
					"description"=>trim($request->description),
					"position"=>$request->position,
					"industry_id"=>$request->industry_type,
					"employment_type_id"=>$request->employment_type,
					"location" => $request->location,
					"min_salary" => $request->min_salary,
					"max_salary" => $request->max_salary,
					"position_department"=>$request->position_department,
					"responsibilty"=>trim($request->responsibilty),
					"image"=>$fileFinalName,
					"job_video"=>$jobVideoName,
					"job_status"=>$request->job_status,
					"status"=>$request->status,
					"created_by"=>$user_id,
				]);	
     if(!empty($request->skill)){
		 $skills = explode(',',$request->skill);
	  foreach($skills as $skill){
		$sk = Skill::where('name', $skill)->first();
		if(!$sk){
		 $sk = $this->skillStore($skill);	
		}
		SkillField::create(['job_id'=>$job->id,"skill_id"=>$sk->id]);
	  }
	 }		
    }	
	
    /* public function jobDestroy(Request $request, $jobID)
    {		
		return true;	
	}*/
	public function jobUpdate(Request $request, $job_id){			
		$request->validate([
				 'company'=> 'required|min:2',
				 'responsibilty'=> 'required'
                ]);
				
		$Job = Job::findOrFail($job_id);
		
		$Job->title = $request->company;
		$Job->description = trim($request->description);
		$Job->position = $request->position;
		$Job->employment_type_id = $request->employment_type;
		$Job->location = $request->location;
    	$Job->industry_id=$request->industry_type;
    	$Job->min_salary = $request->min_salary;
    	$Job->max_salary = $request->max_salary;
		
		$Job->position_department = $request->position_department;
		$Job->responsibilty = trim($request->responsibilty);
		if(!empty($request->job_image)){
            $request->validate(['job_image' => 'mimes:png,jpeg,jpg,gif']);
            $fileFinalName = 'job_'.time().rand(1111,9999).'.'.$request->file('job_image')->getClientOriginalExtension();
            $path = 'public/uploads/jobs/';
            $request->file('job_image')->move($path, $fileFinalName);
			$Job->image = $fileFinalName;
        } 
       
        if(!empty($request->job_video)){	
            $request->validate(['job_video' => 'mimes:mp4,webm']);
            $jobVideoName = 'jobv_'.time().rand(1111,9999).'.'.$request->file('job_video')->getClientOriginalExtension();
            $path = $this->uploadPath.'jobs/videos/';
            $request->file('job_video')->move($path, $jobVideoName);
			$Job->job_video=$jobVideoName;
        }	
		$Job->job_status = $request->job_status;
		$Job->status = $request->status;
		$Job->save();		
		 SkillField::where('job_id',$job_id)->delete();
		if(!empty($request->skill)){
		   $skills = explode(',',$request->skill);
		  foreach($skills as $skill){
			$sk = Skill::where('name', $skill)->first();
			if(!$sk){
			 $sk = $this->skillStore($skill);	
			}
			SkillField::create(['job_id'=>$job_id,"skill_id"=>$sk->id]);
		  }
		}	
	}
	
	public function projectStore(Request $request,$user_id){
		 $request->validate([
				 'name'=> 'required|min:2'
                ]);	
		$project = Project::create([
					"name"=>$request->name, 
					"description"=>trim($request->description),
					"project_status"=>$request->project_status,
					"status"=>$request->status,
					"created_by"=>$user_id,
				]);			
    }
	
	public function projectList(Request $request,$user_id=null)
    {			
        $status= $request->query('status');
        $date = $request->query('date');
		$project_status= $request->query('project_status');
			$project = Project::whereNotNull('id');
		  if(isset($status)){
			$project->where('status', $status);
		  }
		if(isset($project_status) && !empty($project_status)){
		  $project->where('project_status', $project_status);		
		}		
        if(!empty($user_id)){
			$project->where('created_by', $user_id);	
		}
        if ($request->query('date')  != null && $request->query('date') != "change"){
            $project->where('created_at', '>=', $date);
        }

        return $project->latest();
    }
	public function projectUpdate(Request $request, $project_id){			
		$request->validate([
				 'name'=> 'required|min:2',
                ]);
				
		$Project = Project::findOrFail($project_id);
		$Project->name = $request->name;
		$Project->description= trim($request->description);
		$Project->project_status= $request->project_status;
		$Project->status= $request->status;
		$Project->save();		
	}
}