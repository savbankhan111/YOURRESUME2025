<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
	 protected $fillable = [
        'school_name', 'school_code','school_type','more_info','address','city','state','country','zip_code','contact_no','status'
    ];
    protected $guarded = [];
	 public function student()
    {
        return $this->hasMany('App\Models\Student', 'school_id', 'id');
    }
    	public function stateInfo(){
        return $this->hasOne('App\Models\State', 'id', 'state');
    }
	
	public function countryInfo(){
        return $this->hasOne('App\Models\Country', 'id', 'country');
    }
}
