<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
