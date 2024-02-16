<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	public $table="projects";
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization','organization_id','id');
    }
    public function family_books()
    {
        return $this->hasMany('App\Models\Family_book','projects_id','id');
    }
    public function receiving_aids()
    {
        return $this->hasMany('App\Models\Receiving_aid','projects_id','id');
    }
    public function receiving_scholarships()
    {
        return $this->hasMany('App\Models\Receiving_scholarship','projects_id','id');
    }
}
