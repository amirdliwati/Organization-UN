<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
	public $table="visits";
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function family_book()
    {
        return $this->belongsTo('App\Models\Family_book','family_books_id','id');
    }

}
