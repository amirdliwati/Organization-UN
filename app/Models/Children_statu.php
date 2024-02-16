<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Children_statu extends Model
{
	public $table="children_status";
    public function children()
    {
        return $this->hasOne('App\Models\Children','status_id','id');
    }
}
