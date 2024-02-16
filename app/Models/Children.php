<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
	public $table="childrens";
    public function family_book()
    {
        return $this->belongsTo('App\Models\Family_book','family_book_id','id');
    }

    public function children_statu()
    {
        return $this->belongsTo('App\Models\Children_statu','status_id','id');
    }

}
