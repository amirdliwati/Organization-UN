<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receiving_scholarship extends Model
{
	public $table="receiving_scholarships";
    public function family_book()
    {
        return $this->belongsTo('App\Models\Family_book','family_books_id','id');
    }
    public function project()
    {
        return $this->belongsTo('App\Models\Project','projects_id','id');
    }
    public function receiving_scholarship_details()
    {
        return $this->hasMany('App\Models\Receiving_scholarship_detail','receiving_scholarship_id','id');
    }
}
