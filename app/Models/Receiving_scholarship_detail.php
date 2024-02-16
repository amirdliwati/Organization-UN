<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receiving_scholarship_detail extends Model
{
	public $table="receiving_scholarship_details";
    public function receiving_scholarship()
    {
        return $this->belongsTo('App\Models\Receiving_scholarship','receiving_scholarship_id','id');
    }
    public function measuring_unit()
    {
        return $this->belongsTo('App\Models\Measuring_unit','measuring_unit_id','id');
    }
}
