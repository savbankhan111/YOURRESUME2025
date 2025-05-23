<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class IndustriesUser extends Model
{
    protected $guarded = [];
	public $timestamps = false;	
	public function userData(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
	
	public function indData(){
        return $this->hasOne('App\Models\Industry', 'id', 'industry_id');
    }
}
