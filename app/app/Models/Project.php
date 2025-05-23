<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];
	 public function user()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
    public function empData()
    {
        return $this->hasOne('App\Models\Employer', 'user_id','created_by');
    }

	 public function assignUsers()
    {
        return $this->hasMany('App\Models\ProjectUser', 'project_id', 'id');
    }	
}