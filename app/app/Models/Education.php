<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
	protected $fillable = [
        'user_id','code'
    ];
    protected $guarded = [];
	
	 public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
