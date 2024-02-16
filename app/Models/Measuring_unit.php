<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measuring_unit extends Model
{
	public $table="measuring_units";
    public function receiving_aid_details()
    {
        return $this->hasMany('App\Models\Receiving_aid_detail','measuring_unit_id','id');
    }
    public function receiving_scholarship_details()
    {
        return $this->hasMany('App\Models\Receiving_scholarship_detail','measuring_unit_id','id');
    }
}
