<?php 


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SchoolUser extends Model{
    
      public function skuls()
    {
        return $this->belongsToMany('App\Models\School', 'school_user', 'school_id', 'type_id');
    }
    
}