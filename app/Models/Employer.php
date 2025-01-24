<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $guarded = [];

	 public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
