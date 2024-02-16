<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Residence_statu extends Model
{
	public $table="residence_status";
    public function family_books()
    {
        return $this->hasMany('App\Models\Family_book','residence_status_id','id');
    }
}
