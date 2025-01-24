<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UserAddress extends Model
{
    protected $guarded = [];
	public function userData(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
	
	public function stateInfo(){
        return $this->hasOne('App\Models\State', 'id', 'province');
    }
	
	public function countryInfo(){
        return $this->hasOne('App\Models\Country', 'id', 'country');
    }
	
}
