<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wive extends Model
{
	public $table="wives";
    public function family_book()
    {
        return $this->belongsTo('App\Models\Family_book','family_book_id','id');
    }
}
