<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\SkillField;
use App\Models\JobFav;
use App\Models\JobSpareType;
use App\Services\JobProjectService;
use URL;
use Mail;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobProjectController extends Controller{	
	private $uploadPath = "public/uploads/";
    public function jobs(Request $request, JobProjectService $job){

		

		$request->job_status='open';
		$request->status = 'publish';	
	
		$jobs = $job->getActiveUser($request)->paginate(20);
	
		$records = array();

		if(sizeof($jobs) > 0){
			$v = 0;
		 foreach($jobs as $job){
			if($job->image){
			 $job->image = URL::to('/'.$this->uploadPath.'jobs/'.$job->image);
			} if($job->job_video){
			 $job->job_video = URL::to('/'.$this->uploadPath.'jobs/videos/'.$job->job_video);
			}
			 $job->employment_type_id= $job->employmentData->name;
			 $cu_id = User::where('id',$job->created_by)->select('id')->first();
			 $created_by = array();
			if($cu_id){ 
			if($cu_id->employerInfo){
				$created_by['user_id']= $cu_id->id;
				$created_by['company_name']= $cu_id->employerInfo->company_name;
				$company_logo = null;
			  if($cu_id->employerInfo->company_logo){
				 $company_logo = URL::to('/'.$this->uploadPath.'profile/company/'.$cu_id->employerInfo->company_logo);  
			  }
				$created_by['company_logo'] = $company_logo;
				$created_by['company_strength'] = $cu_id->employerInfo->company_strength;
				$job->created_by = $created_by;
			}}		
			$records[$v] = $job;			
			$skills = array();
			$skillField = SkillField::where('job_id',$job->id)->select('skill_id')->get();
		 if(sizeof($skillField) >0){
		  foreach($skillField as $jsf){
			$skills[] = $jsf->skillData['name'];
		  }
		 }
			$records[$v]['skills'] = $skills;		 
			$v++;
		 }			 
		}
		 $job_type = array();
		 $fav_jobs=array();
		if($request->page == 1){
		 $job_type = JobSpareType::where('type', 'employment_type')->select('id','name')->get();
		 	 $fav_jobs = JobFav::where('user_id', $request->id)->pluck('job_id');
		}
		$data = array("message"=>"success","job_type"=>$job_type,"data"=>$records,"favo"=>$fav_jobs);	
	  return response($data, Response::HTTP_OK);
	}    
	
	
	public function favourites(Request $request, JobProjectService $job){

		

		$request->job_status='open';
		$request->status = 'publish';	
	
		$jobs = $job->getfavouriteActiveUser($request)->get();
	
		$records = array();

		if(sizeof($jobs) > 0){
			$v = 0;
		 foreach($jobs as $job){
			if($job->image){
			 $job->image = URL::to('/'.$this->uploadPath.'jobs/'.$job->image);
			} if($job->job_video){
			 $job->job_video = URL::to('/'.$this->uploadPath.'jobs/videos/'.$job->job_video);
			}
			 $job->employment_type_id= $job->employmentData->name;
			 $cu_id = User::where('id',$job->created_by)->select('id')->first();
			 $created_by = array();
			if($cu_id){ 
			if($cu_id->employerInfo){
				$created_by['user_id']= $cu_id->id;
				$created_by['company_name']= $cu_id->employerInfo->company_name;
				$company_logo = null;
			  if($cu_id->employerInfo->company_logo){
				 $company_logo = URL::to('/'.$this->uploadPath.'profile/company/'.$cu_id->employerInfo->company_logo);  
			  }
				$created_by['company_logo'] = $company_logo;
				$created_by['company_strength'] = $cu_id->employerInfo->company_strength;
				$job->created_by = $created_by;
			}}		
			$records[$v] = $job;			
			$skills = array();
			$skillField = SkillField::where('job_id',$job->id)->select('skill_id')->get();
		 if(sizeof($skillField) >0){
		  foreach($skillField as $jsf){
			$skills[] = $jsf->skillData['name'];
		  }
		 }
			$records[$v]['skills'] = $skills;		 
			$v++;
		 }			 
		}
		
		
		$data = array("message"=>"success","data"=>$records);	
	  return response($data, Response::HTTP_OK);
	}
	
	public function insertjobfav(Request $request){
	     JobFav::create([
					"job_id"=>$request->job_id, 
					"user_id"=>$request->user_id
				]);	
					$data = array("message"=>"success","job_type"=>$job_type,"data"=>$records,"favo"=>$fav_jobs);	
	  return response($data, Response::HTTP_OK);
	}
	
		public function removejobfav(Request $request){
	     JobFav::where("user_id",$request->user_id)->where(	"job_id",$request->job_id)->delete();	
					$data = array("message"=>"success","job_type"=>$job_type,"data"=>$records,"favo"=>$fav_jobs);	
	  return response($data, Response::HTTP_OK);
	}
	
	
}