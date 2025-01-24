<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = [
        'user_id','plan_id','start_date','end_date','plan_type','plan_option','total_interview','payment_type','tx_id','total_amount'
    ];
    protected $guarded = [];
	  public function userData()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
