<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
	public $table="logs";
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
