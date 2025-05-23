<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];
    public function users(){
        return $this->belongsToMany('App\User', 'role_user','role_id','user_id');
    }
	public function userActiveTotal(){
        return $this->users()->where("status",'active');
    }
    public function userDisabledTotal(){
        return $this->users()->where("status",'deactivate');
    }
	public function userPendingTotal(){
        return $this->users()->where("status",'pending');
    }
	public function userSuspendTotal(){
        return $this->users()->where("status",'suspend');
    }
}
