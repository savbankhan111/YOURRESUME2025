<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AlertNotification extends Model
{
    protected $guarded = [];
	
	 public function userNotification()
    {
        return $this->hasMany('App\Models\UserNotification','alert_notification_id','id');
    }
}
