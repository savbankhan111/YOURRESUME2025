<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UserProfile extends Model
{
    protected $guarded = [];
	public function userData(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
	
}
