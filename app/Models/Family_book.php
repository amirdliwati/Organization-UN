<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family_book extends Model
{
	public $table="family_books";
    public function addresse()
    {
        return $this->belongsTo('App\Models\Addresse','address_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function marital_statu()
    {
        return $this->belongsTo('App\Models\Marital_statu','marital_status_id','id');
    }
    public function residence_statu()
    {
        return $this->belongsTo('App\Models\Residence_statu','residence_status_id','id');
    }
    public function project()
    {
        return $this->belongsTo('App\Models\Project','projects_id','id');
    }

    public function childrens()
    {
        return $this->hasMany('App\Models\Children','family_book_id','id');
    }
    public function wives()
    {
        return $this->hasMany('App\Models\Wive','family_book_id','id');
    }
    public function receiving_aids()
    {
        return $this->hasMany('App\Models\Receiving_aid','family_books_id','id');
    }
    public function receiving_scholarships()
    {
        return $this->hasMany('App\Models\Receiving_scholarship','family_books_id','id');
    }
    public function visits()
    {
        return $this->hasMany('App\Models\Visit','family_books_id','id');
    }

}
