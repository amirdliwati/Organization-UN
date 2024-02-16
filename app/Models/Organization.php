<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
	public $table="organizations";
    public function projects()
    {
        return $this->hasMany('App\Models\Project','organization_id','id');
    }
}
