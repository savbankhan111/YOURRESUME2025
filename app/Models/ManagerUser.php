<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagerUser extends Model
{
    protected $guarded = [];
	public $timestamps = false;	
	public function user()
	{
		return $this->hasOne("App\User",'id', 'user_id');
	}
}
