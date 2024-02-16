<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receiving_aid extends Model
{
	public $table="receiving_aids";
    public function family_book()
    {
        return $this->belongsTo('App\Models\Family_book','family_books_id','id');
    }
    public function project()
    {
        return $this->belongsTo('App\Models\Project','projects_id','id');
    }
    public function receiving_aid_details()
    {
        return $this->hasMany('App\Models\Receiving_aid_detail','receiving_aid_id','id');
    }
}
