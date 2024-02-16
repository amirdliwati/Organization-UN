<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $table="roles";

    public function role_permissions()
    {
        return $this->hasMany('App\Models\Role_permission','role_id','id');
    }
    public function users()
    {
        return $this->hasMany('App\User','role_id','id');
    }
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'role_permissions', 'role_id', 'permission_id');
    }
}
