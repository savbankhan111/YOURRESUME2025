<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];
	 public function user()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
	 public function employmentData()
    {
        return $this->hasOne('App\Models\JobSpareType', 'id', 'employment_type_id')->select('id','name');
    }

    public function empData()
    {
        return $this->hasOne('App\Models\Employer', 'user_id','created_by');
    }


	 public function skillField()
    {
        return $this->hasMany('App\Models\SkillField', 'job_id', 'id')->where('type','job');
    }
    
     public function users()
    {
        return $this->belongsToMany('App\User', "job_users", "job_id", "user_id");
    }
    
	
}
