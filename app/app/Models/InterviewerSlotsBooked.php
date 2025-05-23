<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewerSlotsBooked extends Model
{
    protected $guarded = [];
	public function userInfo()
	{
		return $this->hasOne("App\User",'id', 'user_id');
	}
}
