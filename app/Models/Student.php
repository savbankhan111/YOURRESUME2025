<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];
	 public function school()
    {
        return $this->hasOne('App\Models\School', 'id', 'school_id');
    }
	public function user()
{
return $this->hasOne("App\User",'id', 'user_id');
}
}
