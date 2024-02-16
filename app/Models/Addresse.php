<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addresse extends Model
{
	public $table="addresses";
    public function family_books()
    {
        return $this->hasMany('App\Models\Family_book','address_id','id');
    }
}
