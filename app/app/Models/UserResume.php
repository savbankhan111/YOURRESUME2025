<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class UserResume extends Model{
    protected $table = 'user_resumes';
    protected $guarded = [];


     public function language()
    {
        return $this->belongsToMany('App\Models\Languages', 'language_fields', 'lang_id', 'type_id');
    }
    
     public function school()
    {
        return $this->belongsToMany('App\Models\School', 'school_user', 'user_id', 'school_id');
    }



}