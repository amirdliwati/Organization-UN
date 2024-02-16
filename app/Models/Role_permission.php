<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Role_permission extends Model
{
    public $table="role_permissions";

    public function role()
    {
        return $this->belongsTo('App\Models\Role','role_id','id');
    }

    public function permission()
    {
        return $this->belongsTo('App\Models\Permission','permission_id','id');
    }

}
