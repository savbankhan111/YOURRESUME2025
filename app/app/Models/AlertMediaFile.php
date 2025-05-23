<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AlertMediaFile extends Model
{
    protected $guarded = [];
	protected $fillable = [
        'parent_id', 'media_file', 'type','sent_by'
    ];
	 public function parentAlert()
    {
        return $this->hasOne('App\Models\ParentAlert', 'id', 'parent_id');
    }
	 public function user()
    {
        return $this->hasOne('App\User', 'id', 'sent_by');
    }
}