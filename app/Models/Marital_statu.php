<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marital_statu extends Model
{
	public $table="marital_status";
    public function family_books()
    {
        return $this->hasMany('App\Models\Family_book','marital_status_id','id');
    }
}
