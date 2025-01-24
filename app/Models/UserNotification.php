<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $guarded = [];
	public $timestamps = false;	
	 public function alert_notification()
    {
        return $this->hasOne('App\Models\AlertNotification', 'id', 'alert_notification_id');
    }
	 public function user()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }
}
