<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receiving_aid_detail extends Model
{
	public $table="receiving_aid_details";
    public function receiving_aid()
    {
        return $this->belongsTo('App\Models\Receiving_aid','receiving_aid_id','id');
    }
    public function measuring_unit()
    {
        return $this->belongsTo('App\Models\Measuring_unit','measuring_unit_id','id');
    }
}
