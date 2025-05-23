<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillField extends Model
{
    protected $guarded = [];
	 public function jobData()
    {
        return $this->hasOne('App\Models\Job', 'id', 'job_id');
    }
	 public function skillData()
    {
        return $this->hasOne('App\Models\Skill', 'id', 'skill_id');
    }
}
