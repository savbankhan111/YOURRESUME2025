<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $guarded = [];
	public function user()
	{
		return $this->hasOne("App\User",'id', 'user_id');
	}
	public function projectData()
	{
		return $this->hasOne("App\Models\Project",'id', 'project_id');
	}
}
